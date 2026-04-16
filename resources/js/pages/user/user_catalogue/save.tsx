import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import CustomCard from '@/components/ui/custom-card';
import CustomNotice from '@/components/ui/custom-notice';
import CustomPageHeading from '@/components/ui/customer-page-heading';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import user_catalogue from '@/routes/user_catalogue';
import { IDateTime, type BreadcrumbItem, type PageConfig } from '@/types';
import { Form, Head } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { useEffect, useRef } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Quản lý nhóm thành viên',
        href: '/',
    },
];

const pageConfig: PageConfig = {
    heading: 'Quản lý nhóm thông viên',
};

export interface UserCatalogue extends IDateTime {
    id: number;
    name: string;
    canonical: string;
    description: string;
}

interface UserCatalogueSaveProps {
    data?: UserCatalogue;
}

export default function UserCatalogueSave({ data }: UserCatalogueSaveProps) {
    const buttonAction = useRef('');
    const isEdit = !!data;

    useEffect(() => {
        if (isEdit) {
            buttonAction.current = 'update';
        } else {
            buttonAction.current = 'create';
        }
    }, [isEdit]);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={pageConfig.heading} />
            <div className="rounded-x l page-wrapper flex h-full flex-1 flex-col gap-4 overflow-x-auto">
                <CustomPageHeading
                    heading={pageConfig.heading}
                    breadcrumbs={breadcrumbs}
                />
                <div className="page-container">
                    <div className="grid grid-cols-12 gap-4">
                        <div className="col-span-5">
                            <CustomNotice />
                        </div>
                        <div className="col-span-7">
                            <Form
                                action = {isEdit ? user_catalogue.update(data?.id) : user_catalogue.store()}
                                resetOnSuccess={[
                                    'name',
                                    'canonical',
                                    'description',
                                ]}
                                transform={(data) => ({
                                    ...data,
                                    ...(isEdit ? { _method: 'put' }: {}),
                                    save_and_redirect: buttonAction.current,
                                })}
                                method="post"
                            >
                                {({ processing, errors }) => (
                                    <>
                                        <CustomCard
                                            isShowHeader={true}
                                            title="Thông tin chung"
                                            description="Nhập đầy đủ các thông tin dưới đây"
                                        >
                                            <div className="mb-[20px] grid grid-cols-2 gap-4">
                                                <div className="col-span-1">
                                                    <Label
                                                        htmlFor="name"
                                                        className="mb-[10px]"
                                                    >
                                                        Tên nhóm thông viên
                                                    </Label>
                                                    <Input
                                                        id="name"
                                                        type="text"
                                                        tabIndex={1}
                                                        name="name"
                                                        autoFocus
                                                        autoComplete="name"
                                                        placeholder=""
                                                        defaultValue={data?.name }
                                                        className="mt-1 block w-full"
                                                    />
                                                    <InputError
                                                        message={errors.name}
                                                        className="mt-[5px]"
                                                    />
                                                </div>
                                                <div className="col-span-1">
                                                    <Label
                                                        htmlFor="canonical"
                                                        className="mb-[10px]"
                                                    >
                                                        Từ khoá
                                                    </Label>
                                                    <Input
                                                        id="canonical"
                                                        type="text"
                                                        tabIndex={1}
                                                        name="canonical"
                                                        autoFocus
                                                        autoComplete=""
                                                        placeholder=""
                                                        defaultValue={data?.canonical}
                                                        className="mt-1 block w-full"
                                                    />
                                                    <InputError
                                                        message={
                                                            errors.canonical
                                                        }
                                                        className="mt-[5px]"
                                                    />
                                                </div>
                                            </div>
                                            <div>
                                                <Label
                                                    htmlFor="description"
                                                    className="mb-[10px]"
                                                >
                                                    Mô tả ngắn
                                                </Label>
                                                <Textarea
                                                    name="description"
                                                    className="h-[168px]"
                                                    autoFocus
                                                    tabIndex={1}
                                                    autoComplete=""
                                                    placeholder=""
                                                    defaultValue={data?.description}
                                                />
                                            </div>

                                            <div className="mt-[20px]">
                                                <div className="flex space-x-2">
                                                    <Button
                                                        type="submit"
                                                        tabIndex={4}
                                                        disabled={processing}
                                                        onClick={() => {
                                                            buttonAction.current =
                                                                '';
                                                        }}
                                                        className="w-[150px] cursor-pointer rounded-[5px] font-light"
                                                    >
                                                        {processing && (
                                                            <LoaderCircle className="mr-2 h-4 w-4 animate-spin" />
                                                        )}
                                                        Lưu lại
                                                    </Button>
                                                    <Button
                                                        type="submit"
                                                        tabIndex={4}
                                                        disabled={processing}
                                                        onClick={() => {
                                                            buttonAction.current =
                                                                'redirect';
                                                        }}
                                                        className="w-[150px] cursor-pointer rounded-[5px] bg-blue-500 font-light"
                                                    >
                                                        {processing && (
                                                            <LoaderCircle className="mr-2 h-4 w-4 animate-spin" />
                                                        )}
                                                        Lưu lại và đóng
                                                    </Button>
                                                </div>
                                            </div>
                                        </CustomCard>
                                    </>
                                )}
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
