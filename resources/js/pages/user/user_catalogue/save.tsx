import { Button } from '@/components/ui/button';
import CustomCard from '@/components/ui/custom-card';
import CustomNotice from '@/components/ui/custom-notice';
import CustomPageHeading from '@/components/ui/customer-page-heading';
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem, type PageConfig } from '@/types';
import { zodResolver } from '@hookform/resolvers/zod';
import { Head } from '@inertiajs/react';
import { useForm } from 'react-hook-form';
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
    const form = useForm<TFormValues>({
        resolver: zodResolver(schema),
        defaultValues: {
            name: '',
            canonical: '',
            description: '',
        },
    });

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
                            <Form {...form}>
                                <CustomCard
                                    isShowHeader={true}
                                    title="Thông tin chung"
                                    description="Nhập đầy đủ các thông tin dưới đây"
                                >
                                    <div className="mb-[20px] grid grid-cols-2 gap-4">
                                        <div className="col-span-1">
                                            <FormField
                                                control={form.control}
                                                name="name"
                                                render={({ field }) => (
                                                    <FormItem>
                                                        <FormLabel>
                                                            Tên nhóm thành viên
                                                        </FormLabel>
                                                        <FormControl>
                                                            <Input
                                                                {...field}
                                                                className="form-input"
                                                            />
                                                        </FormControl>
                                                        <FormMessage />
                                                    </FormItem>
                                                )}
                                            ></FormField>
                                        </div>
                                        <div className="col-span-1">
                                            <FormField
                                                control={form.control}
                                                name="canonical"
                                                render={({ field }) => (
                                                    <FormItem>
                                                        <FormLabel>
                                                            Từ khoá nhóm
                                                        </FormLabel>
                                                        <FormControl>
                                                            <Input
                                                                {...field}
                                                                className="form-input"
                                                            />
                                                        </FormControl>
                                                        <FormMessage />
                                                    </FormItem>
                                                )}
                                            ></FormField>
                                        </div>
                                    </div>
                                    <FormField
                                        control={form.control}
                                        name="description"
                                        render={({ field }) => (
                                            <FormItem>
                                                <FormLabel>Mô tả</FormLabel>
                                                <FormControl>
                                                    <Textarea {...field} className='h-[168px]' />
                                                </FormControl>
                                                <FormMessage />
                                            </FormItem> 
                                        )}
                                    ></FormField>
                                    <div className='mt-[20px]'>
                                        <Button className='bg-[#17b9] rounded-[5px] font-light cursor-pointer'>
                                            Lưu lại
                                        </Button>
                                    </div>
                                </CustomCard>
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
