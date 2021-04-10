export default [
    {
        header: "Apps & Pages"
    },
    {
        title: "User Managements",
        icon: "UserIcon",
        children: [
            {
                title: "Manage Roll",
                route: "role"
            },
            {
                title: "Manage User",
                route: "user"
            },
            {
                title: "Assign Permission",
                route: "permission"
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

            },
            {
                title: 'Products',
                route: 'product',

            },
            {
                title: 'Brands',
                route: 'brand',

            },
            {
                title: 'Courier Company',
                route: 'courier-company',

            },
            {
                title: 'Vendor',
                route: 'vendor',

            }

        ]
    },



    {
        title: "Order Managements",
        icon: "ShoppingCartIcon",
        children: [

            {
                title: ' Orders',
                route: 'order',

            },
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
