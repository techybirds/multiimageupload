function loadComponent(view) {
    return () =>
        import(/* webpackChunkName: "[request]" */ `./components/${view}`);
}


var router = {
    mode: "history",
    routes: [
        {
            path:'/',
            name:'main',
            component:loadComponent('MainForm'),
        },

        {
            path:'/list-form-details',
            name:'list_form_details',
            component:loadComponent('ListFormDetails'),
        },

        {
            path:'/list-form-details/images/:form_id',
            name:'list_form_images',
            component:loadComponent('ListFormImages'),
        },


        //end here
        {
            path: "*",
            name: "404",
            component: loadComponent("404"),
        }
    ]
};

export var Router = router;

