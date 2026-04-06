import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Thêm mới  nhóm thành viên',
        href: '/',
    },
];

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={ breadcrumbs}>
            <Head title="Quản lý nhóm thành viên" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl">
                Thêm mới
            </div>
        </AppLayout>
    );
}
