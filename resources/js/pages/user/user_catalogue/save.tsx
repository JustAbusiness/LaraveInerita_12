import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import CustomCard from '@/components/ui/custom-card';
import CustomNotice from '@/components/ui/custom-notice';
import CustomPageHeading from '@/components/ui/customer-page-heading';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import user_catalogue from '@/routes/user_catalogue';
import { type BreadcrumbItem, type PageConfig } from '@/types';
import { Textarea } from '@/components/ui/textarea';
import { Form, Head } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import * as z from 'zod';

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

const schema = z.object({
    name: z.string().min(1, { message: 'Tên nhóm thành viên là bắt buộc' }),
    canonical: z
        .string()
        .min(1, { message: 'Từ khoá nhóm thành viên là bắt buộc' }),
    description: z.string().optional(),
});

export type TFormValues = z.infer<typeof schema>;

const pageConfig: PageConfig<TFormValues> = {
    schema: schema,
    heading: 'Quản lý nhóm thông viên',
};

export default function UserCatalogueSave() {
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
                            <Form action={user_catalogue.store()} method="post">
                                {({ processing, errors }) => (
                                    <>
                                        <CustomCard
                                            isShowHeader={true}
                                            title="Thông tin chung"
                                            description="Nhập đầy đủ các thông tin dưới đây"
                                        >
                                            <div className="mb-[20px] grid grid-cols-2 gap-4">
                                                <div className="col-span-1">
                                                    <Label htmlFor='name' className="mb-[10px]">
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
                                                        className="mt-1 block w-full"
                                                    />
                                                    <InputError
                                                        message={errors.name}
                                                        className='mt-[5px]'
                                                    /> 
                                                </div>
                                                <div className="col-span-1">
                                                    <Label htmlFor='canonical' className="mb-[10px]">
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
                                                        className="mt-1 block w-full"
                                                    />
                                                    <InputError
                                                        message={errors.canonical}
                                                        className='mt-[5px]'
                                                    />
                                                </div>
                                            </div>
                                            <div>
                                                <Label htmlFor='description' className="mb-[10px]">
                                                    Mô tả ngắn
                                                </Label>
                                                <Textarea
                                                    name="description"
                                                    className='h-[168px]'
                                                    autoFocus
                                                    tabIndex={1}
                                                    autoComplete=''
                                                    placeholder=''
                                                />
                                            </div>

                                            <div className="mt-[20px]">
                                                <Button
                                                    type="submit"
                                                    tabIndex={4}
                                                    disabled={processing}
                                                    className="w-[150px] cursor-pointer rounded-[5px] font-light"
                                                >
                                                    {processing && (
                                                        <LoaderCircle className="mr-2 h-4 w-4 animate-spin" />
                                                    )}
                                                    Lưu lại
                                                </Button>
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
