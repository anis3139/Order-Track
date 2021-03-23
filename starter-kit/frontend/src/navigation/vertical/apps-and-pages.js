export default [
    {
        header: "Apps & Pages"
    },
    {
        title: "User Managements",
        icon: "UserIcon",
        children: [
            {
                title: "Admin",
                route: ""
            },
            {
                title: "User",
                route: ""
            }
        ]
    },





    {
        title: "Product Settings",
        icon: "ShoppingBagIcon",
        children: [

           
            {
                title: 'Category',
                route: 'category',
                icon: 'FileIcon',
            },
            {
                title: 'Products',
                route: 'product',
                icon: 'FileIcon',
            },
            {
                title: 'Brands',
                route: 'brand',
                icon: 'FileIcon',
            },
            {
                title: 'Courier Company',
                route: 'courier-company',
                icon: 'FileIcon',
            }
           
        ]
    },
    


    {
        title: "Order Managements",
        icon: "ShoppingCartIcon",
        children: [

            {
                title: ' New Orders',
                route: '',

            },
            {
                title: 'Proccessing Orders',
                route: '',

            },
            {
                title: ' Complete Orders',
                route: '',

            },
            {
                title: ' Cancel Orders',
                route: '',


            }
        ]
    },

    {
        title: "Transaction Managements",
        icon: "DollarSignIcon",
        children: [

            {
                title: 'User Pending  Commission',
                route: '',

            },
            {
                title: 'User Complete Commission',
                route: '',

            },
            {
                title: 'Withdraw Requests',
                route: '',

            },

        ]
    },

    
    {
        title: "Invoice",
        icon: "FileTextIcon",
        children: [
            {
                title: "List",
                route: "apps-invoice-list"
            },
            {
                title: "Preview",
                route: { name: "apps-invoice-preview", params: { id: 4987 } }
            },
            {
                title: "Edit",
                route: { name: "apps-invoice-edit", params: { id: 4987 } }
            },
            {
                title: "Add",
                route: { name: "apps-invoice-add" }
            }
        ]
    },
];
