import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/react';
import { AtSign, KeyRound } from 'lucide-react';

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}

export default function Login({
    status,
    canResetPassword,
    canRegister,
}: LoginProps) {
    return (
        <AuthLayout
            title="Log in"
            description="Welcome back! Please enter your details."
        >
            <Head title="Log in" />

            <Form
                {...store.form()}
                resetOnSuccess={['password']}
                className="space-y-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="space-y-5">
                            <div className="grid gap-2">
                                <Label htmlFor="email" className="text-zinc-300 font-medium">Email Address</Label>
                                <div className="group relative">
                                    <div className="absolute inset-0 rounded-lg bg-primary/20 opacity-0 blur transition-opacity group-focus-within:opacity-100" />
                                    <div className="relative">
                                        <AtSign className="absolute top-1/2 left-3.5 size-4.5 -translate-y-1/2 text-zinc-500 transition-colors group-focus-within:text-primary" />
                                        <Input
                                            id="email"
                                            type="email"
                                            name="email"
                                            required
                                            autoFocus
                                            tabIndex={1}
                                            autoComplete="email"
                                            placeholder="you@example.com"
                                            className="h-12 border-white/10 bg-white/[0.03] pl-11 text-white placeholder:text-zinc-600 focus-visible:ring-primary/30"
                                        />
                                    </div>
                                </div>
                                <InputError message={errors.email} className="text-pink-500/90 text-xs mt-1" />
                            </div>

                            <div className="grid gap-2">
                                <div className="flex items-center justify-between">
                                    <Label htmlFor="password" title="Password" className="text-zinc-300 font-medium">Password</Label>
                                    {canResetPassword && (
                                        <TextLink
                                            href={request()}
                                            className="text-xs font-semibold text-primary hover:text-primary/80"
                                            tabIndex={5}
                                        >
                                            Forgot password?
                                        </TextLink>
                                    )}
                                </div>
                                <div className="group relative">
                                    <div className="absolute inset-0 rounded-lg bg-primary/20 opacity-0 blur transition-opacity group-focus-within:opacity-100" />
                                    <div className="relative">
                                        <KeyRound className="absolute top-1/2 left-3.5 size-4.5 -translate-y-1/2 text-zinc-500 transition-colors group-focus-within:text-primary" />
                                        <Input
                                            id="password"
                                            type="password"
                                            name="password"
                                            required
                                            tabIndex={2}
                                            autoComplete="current-password"
                                            placeholder="••••••••"
                                            className="h-12 border-white/10 bg-white/[0.03] pl-11 text-white placeholder:text-zinc-600 focus-visible:ring-primary/30"
                                        />
                                    </div>
                                </div>
                                <InputError message={errors.password} className="text-pink-500/90 text-xs mt-1" />
                            </div>

                            <div className="flex items-center space-x-2 py-1">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    tabIndex={3}
                                    className="border-white/20 data-[state=checked]:bg-primary data-[state=checked]:border-primary"
                                />
                                <Label htmlFor="remember" className="text-sm font-medium text-zinc-400 cursor-pointer select-none hover:text-zinc-300 transition-colors">
                                    Keep me logged in
                                </Label>
                            </div>

                            <Button
                                type="submit"
                                className="h-12 w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] hover:shadow-indigo-500/40 active:scale-[0.98] border-none"
                                tabIndex={4}
                                disabled={processing}
                            >
                                {processing ? <Spinner className="mr-2 text-white" /> : null}
                                Sign In
                            </Button>
                        </div>

                        {canRegister && (
                            <div className="pt-2 text-center text-sm text-zinc-500">
                                Don't have an account?{' '}
                                <TextLink href={register()} tabIndex={5} className="font-bold text-white hover:text-primary transition-colors">
                                    Join for free
                                </TextLink>
                            </div>
                        )}
                    </>
                )}
            </Form>

            {status && (
                <div className="mt-6 rounded-lg bg-emerald-500/10 p-3 text-center text-xs font-bold text-emerald-400 border border-emerald-500/20">
                    {status}
                </div>
            )}
        </AuthLayout>
    );
}
