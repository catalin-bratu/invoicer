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
    iban?: string;
    bank?: string;
    created_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    status?: string;
};

export interface Paginator<T> {
    data: T[];
    from: number | null;
    to: number | null;
    prev_page_url: string | null;
    next_page_url: string | null;
}
