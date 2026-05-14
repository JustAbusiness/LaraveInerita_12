import { Link } from "@inertiajs/react";
import { type BreadcrumbItem } from "@/types";

interface CustomPageHeadingProps {
    heading: string;
    breadcrumbs: BreadcrumbItem[];
}

const CustomPageHeading = ({ heading, breadcrumbs}: CustomPageHeadingProps) => {
    return (
        <div className="border-b border-zinc-200 page-heading px-6 py-6 bg-white shadow-sm">
            {heading && <h2 className="text-[20px] uppercase font-bold mb-2 text-zinc-900 tracking-tight">{heading}</h2>}
            <ol className="custom-breadcrumb flex items-center gap-2 text-sm text-zinc-500">
                {breadcrumbs.map((item, index) =>
                    <li key={item.title} className="flex items-center gap-2">
                        {index > 0 && <span className="text-zinc-300">/</span>}
                        <Link 
                            href={item.href} 
                            className={`hover:text-indigo-600 transition-colors ${index === breadcrumbs.length - 1 ? 'font-medium text-zinc-900' : ''}`}
                        >
                            {item.title}
                        </Link >
                    </li>
                )}
            </ol>
        </div>
    )
}

export default CustomPageHeading;
