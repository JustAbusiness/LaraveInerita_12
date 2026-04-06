import AppLogoIcon from '@/components/app-logo-icon';
import { home } from '@/routes';
import { Link } from '@inertiajs/react';
import { type PropsWithChildren } from 'react';

interface AuthLayoutProps {
    name?: string;
    title?: string;
    description?: string;
}

export default function AuthSimpleLayout({
    children,
    title,
    description,
}: PropsWithChildren<AuthLayoutProps>) {
    return (
        <div className="relative flex min-h-svh flex-col items-center justify-center gap-6 overflow-hidden bg-background p-6 md:p-10">
            {/* Background decorative elements */}
            <div className="absolute inset-0 z-0 overflow-hidden">
                <div className="absolute -top-[10%] -left-[10%] h-[40%] w-[40%] animate-pulse rounded-full bg-primary/10 blur-[120px]" />
                <div className="absolute top-[20%] -right-[10%] h-[35%] w-[35%] animate-pulse rounded-full bg-chart-1/10 blur-[100px] [animation-delay:2s]" />
                <div className="absolute -bottom-[10%] left-[20%] h-[30%] w-[30%] animate-pulse rounded-full bg-chart-2/10 blur-[80px] [animation-delay:4s]" />
            </div>

            <div className="relative z-10 w-full max-w-sm">
                <div className="flex flex-col gap-8">
                    <div className="flex flex-col items-center gap-4">
                        <Link
                            href={home()}
                            className="flex flex-col items-center gap-2 font-medium transition-transform hover:scale-105"
                        >
                            <div className="mb-1 flex h-12 w-12 items-center justify-center rounded-xl bg-primary shadow-lg shadow-primary/20">
                                <AppLogoIcon className="size-8 fill-current text-primary-foreground" />
                            </div>
                            <span className="sr-only">{title}</span>
                        </Link>

                        <div className="space-y-2 text-center">
                            <h1 className="text-2xl font-bold tracking-tight">{title}</h1>
                            <p className="text-center text-sm text-muted-foreground">
                                {description}
                            </p>
                        </div>
                    </div>
                    <div className="rounded-2xl border bg-card p-8 shadow-xl shadow-black/5 dark:shadow-none">
                        {children}
                    </div>
                </div>
            </div>
        </div>
    );
}
