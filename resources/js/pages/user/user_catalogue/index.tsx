import { Button } from '@/components/ui/button';
import CustomCard from '@/components/ui/custom-card';
import CustomPageHeading from '@/components/ui/customer-page-heading';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type PageConfig } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { PlusCircle } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Danh sách nhóm thành viên',
        href: '/',
    },
];

const pageHeading: PageConfig = {
    module: 'user_catalogue',
    heading: 'Danh sách nhóm thông viên',
    cardHeading: 'Bảng quản lý danh sách nhóm thông viên',
    cardDescription:
        'Quản lý thông tin danh sách nhóm thông viên, sử dụng các chức năng để lọc dữ liệu',
};

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Quản lý nhóm thành viên" />
            <div className="page-wrapper flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl">
                <CustomPageHeading heading="" breadcrumbs={breadcrumbs} />

                <div className="page-container">
                    <CustomCard
                        isShowHeader={true}
                        isShowFooter={true}
                        title={pageHeading.cardHeading}
                        description={pageHeading.cardDescription}
                    >
                        <div className="mb-[10px] flex items-center justify-between">
                            <div className=""> Lọc dữ liệu </div>
                            <Link
                                href={`${pageHeading.module}/create`}
                                className="ml-[10px]"
                            >
                                <Button className="cursor-pointer rounded-[5px] bg-[#ed5565] shadow hover:bg-[#ed5565]/80">
                                    <PlusCircle />
                                    Thêm bản ghi mới
                                </Button>
                            </Link>
                        </div>
                    </CustomCard>
                </div>
            </div>
        </AppLayout>
    );
}
