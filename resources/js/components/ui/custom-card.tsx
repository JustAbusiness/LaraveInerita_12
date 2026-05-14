import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Loader2 } from 'lucide-react';

interface CustomCardProps {
    loading?: boolean;
    title?: string;
    description?: string;
    height?: string;
    isShowHeader?: boolean;
    isShowFooter?: boolean;
    children?: React.ReactNode;
    footerChildren?: React.ReactNode;
    className?: string;
}
const CustomCard = ({
    loading,
    title,
    description,
    height,
    isShowHeader,
    isShowFooter,
    children,
    footerChildren,
    className,
}: CustomCardProps) => {
    return (
        <Card className={`relative overflow-hidden rounded-[5px] pt-[20px] ${className}`}>
            {isShowHeader && (
                <CardHeader className="border-b border-zinc-100 mb-6">
                    <CardTitle className="uppercase text-zinc-900 font-bold tracking-tight">{title}</CardTitle>
                    <CardDescription className="text-zinc-500 font-medium">{description}</CardDescription>
                </CardHeader>
            )}
            <CardContent className={`${height ?? 'h-[48]'}`}>
                {children}
            </CardContent>
            {isShowFooter && (
                <CardFooter className="flex justify-center">
                    {footerChildren}
                </CardFooter>
            )}
            {loading && (
                <div className="absolute inset-0 z-10 flex items-center justify-center bg-white/70 dark:bg-black/40">
                    <Loader2 className="size-8 animate-spin text-muted-foreground" />
                </div>
            )}
        </Card>
    );
};

export default CustomCard;
