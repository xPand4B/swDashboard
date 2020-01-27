const routes = [
    {
        path: '/',
        component: () => import('../Layouts/Default'),
        children: [
            {
                path: '/',
                name: 'management.index',
                component: () => import('../Pages/Management/Index'),
            }
        ]
    }
];

export default routes;
