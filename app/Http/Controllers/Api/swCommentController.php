<?php

namespace App\Http\Controllers\Api;

use App\Helper\swDirectoryHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class swCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (! request('version')) {
            return response()->json(
                "Version could not be found.", 404
            );
        }

        if (! $request->has('comments')) {
            return response()->json(
                "No comments set.", 422
            );
        }

        $version = request('version');
        $comment = request('comment');

        $file = $this->getCommentFileByVersion($version);

        if (! $file[0]) {
            return $file[1];
        }
        $file = $file[1];

        $existingComments = '';

        if (file_exists($file)) {
            $existingComments = file_get_contents($file).'|';
        }

        file_put_contents($file, $existingComments.$comment);

        return response()->json(
            "Added comment: ".$comment, 201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param string $version
     * @return mixed
     */
    public function show(string $version)
    {
        $file = $this->getCommentFileByVersion($version);

        if (! $file[0]) {
            return $file[1];
        }
        $file = $file[1];

        if (! file_exists($file)) {
            return response()->json(
                "Version '".$version."' has no comments yet.", 200
            );
        }

        $comments = file_get_contents($file);
        $comments = explode('|', $comments);

        foreach ($comments as $key => $comment) {
            $comments[$key] = trim(preg_replace('/\s\s+/', ' ', $comment));
        }

        return response()->json([
            'comments' => $comments
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function destroy(Request $request)
    {
        if (! request('version')) {
            return response()->json(
                "Version could not be found.", 404
            );
        }

        if (! request('comments')) {
            return response()->json(
                "No comments set.", 422
            );
        }

        $version = request('version');
        $comments = explode('|', request('comments'));

        $file = $this->getCommentFileByVersion($version);

        if (! $file[0]) {
            return $file[1];
        }
        $file = $file[1];

        if (! file_exists($file)) {
            return response()->json(
                "Version '".$version."' has no comments yet.", 200
            );
        }

        $existingComments = explode('|', file_get_contents($file));

        foreach ($comments as $key => $comment) {
            if (! in_array($comment, $existingComments)) {
                continue;
            }

            $arrayPosition = array_keys($existingComments, $comment, true);

            unset($existingComments[$arrayPosition[0]]);
        }

        unlink($file);

        if (! empty($existingComments)) {
            $newComments = array_values($existingComments);
            $newComments = implode('|', $newComments);
            file_put_contents($file, $newComments);
        }

        return response()->json(
            "Comments have been deleted.", 200
        );
    }

    /**
     * Returns the comment file based on the specified version.
     *
     * @param string $version
     * @return array
     */
    private function getCommentFileByVersion(string $version): array
    {
        $basePath = swDirectoryHelper::GetBaseDirFromVersion($version);
        $basePath .= DIRECTORY_SEPARATOR.$version;

        if (! file_exists($basePath)) {
            return [
                false,
                response()->json(
                "Version '".$version."' could not be found.", 404
                )
            ];
        }

        $file = $basePath.DIRECTORY_SEPARATOR.'swComments.txt';

        return [ true, $file ];
    }
}
