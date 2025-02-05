export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Customer {
    id: string;
    name: string;
    vat?: string;
    email?: string;
    phone?: string;
    created_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

export interface Paginator<T> {
    data: T[];
    prev_page_url: string | null;
    next_page_url: string | null;
}
