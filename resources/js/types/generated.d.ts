declare namespace App.Data {
export type AuthData = {
email: string;
    isVerified: boolean;
    canEditOrders: boolean;
};
export type CartData = {
id: number;
product: App.Data.ProductData;
quantity: number;
};
export type DeliveryRegionData = {
id: number;
name: string;
};
export type OrderData = {
id: number;
address: App.Data.UserAddressData;
order_items: Array<App.Data.OrderItemData>;
total_price: number;
status: string;
    allStatuses: Array<any> | null;
payment_method: string;
    current_account: string | null;
    bank_address: string | null;
    bik: string | null;
    unp: string | null;
    okpo: string | null;
    doc_url: string | null;
};
export type OrderItemData = {
product: App.Data.ProductData;
quantity: number;
total_price: number;
};
export type PaginateLinksData = {
url: string | null;
label: string;
active: boolean;
};
export type PaginateProductData = {
data: Array<App.Data.ProductData>;
links: Array<App.Data.PaginateLinksData>;
current_page: number;
};
export type ProductData = {
id: number;
title: string;
slug: string;
description: string | null;
certificateUrl: string | null;
conformityDeclaration: string | null;
deliveryRegions: Array<App.Data.DeliveryRegionData>;
productImages: Array<App.Data.ProductImageData> | null;
price: number;
priceUnits: string;
standard: App.Data.StandardData;
};
export type ProductImageData = {
id: number;
imageUrl: string;
};
export type StandardData = {
id: number;
name: string;
};
export type UserAddressData = {
id: number | null;
country: string;
region: string;
city: string;
address: string;
zipcode: string;
fio: string;
phone_number: string;
};
}
declare namespace App.Enums {
    export type OrderStatus = 'Доставлено' | 'Доставляется' | 'Требует оплаты по реквизитам' | 'Ожидает подтверждения';
    export type PaymentMethod = 'Наличными при получении' | 'Картой при получении' | 'Онлайн по реквизитам';
}
