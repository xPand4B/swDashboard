import { swLayoutDefault } from '../layouts';
import { ShoplistIndex} from '../pages';

const routes = [
    {
        path: '/',
        component: swLayoutDefault,
        children: [
            {
                path: '/',
                name: 'shoplist.index',
                component: ShoplistIndex
            }
        ]
    }
];

export default routes;
