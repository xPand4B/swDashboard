import { swLayoutDefault } from "../Layouts";
import { ShopListIndex } from "../Pages";

const routes = [
    {
        path: '/',
        component: swLayoutDefault,
        children: [
            {
                path: '/',
                name: 'shoplist.index',
                component: ShopListIndex
            }
        ]
    }
];

export default routes;
