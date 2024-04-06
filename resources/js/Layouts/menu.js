export default [
    {
        header: 'Main Navigation',
        hiddenOnCollapse: true
    },
    {
        href: '/dashboard',
        title: 'Dashboard',
        icon: 'fa fa-user'
    },
    {
        href: '/hotel',
        title: 'hotel',
        icon: 'fa fa-hotel',
        child: [
            {
                href: 'hotel/rooms',
                title: 'Rooms',
            },
            {
                href: 'hotel/service',
                title: 'Service',
            }
        ]

    }
]