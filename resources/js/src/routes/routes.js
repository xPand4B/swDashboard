const routes = [
    {
        path: '/',
        component: () => import('../Layouts/Default'),
        children: [
            {
                path: '/',
                name: 'shoplist.index',
                components: {
                    default: () => import('../Pages/Shoplist/Index'),
                },
                children: [
                    {
                        path: '/',
                        name: 'shoplist.create',
                        components: {
                            default: () => import('../Pages/Shoplist/Create')
                        }
                    }
                ]
            }
        ]
    }
];

export default routes;
