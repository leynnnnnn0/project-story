<script setup>
import Layout from "@/Layouts/App.vue";
import { Badge } from "@/components/ui/badge";
import { router } from "@inertiajs/vue3";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover";

import { Filter } from "lucide-vue-next";
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
const handleClick = () => {
    router.get("/store-orders/create");
};

const props = defineProps({
    orders: {
        type: Object,
    },
});

let from = ref(usePage().props.from);
let to = ref(usePage().props.to);

watch(from, (value) => {
    router.get(
        route("store-orders.index"),
        { from: value, to: to.value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
});

watch(to, (value) => {
    router.get(
        route("store-orders.index"),
        { from: from.value, to: value },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
});

const statusClass = (status) =>
    status === "RECEIVED"
        ? "bg-green-500 text-white"
        : "bg-yellow-500 text-white";
</script>

<template>
    <Layout
        heading="Store Orders"
        :hasButton="true"
        buttonName="Create New Order"
        :handleClick="handleClick"
    >
        <DivFlexCol
            class="p-5 w-full h-full rounded-lg border border-gray/20 space-y-5"
        >
            <DivFlexCenter class="justify-between">
                <!-- Search Bar-->
                <Input
                    type="text"
                    placeholder="Search..."
                    class="w-96 rounded-lg border-gray-200"
                />
                <DivFlexCenter class="gap-5">
                    <Popover>
                        <PopoverTrigger> <Filter /> </PopoverTrigger>
                        <PopoverContent>
                            <label class="text-xs">From</label>
                            <Input type="date" v-model="from" />
                            <label class="text-xs">To</label>
                            <Input type="date" v-model="to" />
                        </PopoverContent>
                    </Popover>
                </DivFlexCenter>
            </DivFlexCenter>

            <Table>
                <thead>
                    <tr>
                        <TH>Id</TH>
                        <TH>Vendor</TH>
                        <TH>Store</TH>
                        <TH>Order Placed At</TH>
                        <TH>Order #</TH>
                        <TH>Order Date</TH>
                        <TH>Order Items</TH>
                        <TH>Order Quantity</TH>
                        <TH>Receiving Status</TH>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="order in orders.data" :key="order.id">
                        <TD>{{ order.Id }}</TD>
                        <TD>{{ order.vendor?.Name ?? "N/A" }}</TD>
                        <TD>{{ order.branch?.Name ?? "N/A" }}</TD>
                        <TD>{{ order.created_at }}</TD>
                        <TD>{{ order.SONumber }}</TD>
                        <TD>{{ order.OrderDate }}</TD>
                        <TD>{{ order.Total_Item }}</TD>
                        <TD>{{ order.TOTALQUANTITY ?? 0 }}</TD>
                        <TD>
                            <Badge :class="statusClass(order.Status)">{{
                                order.Status
                            }}</Badge>
                        </TD>
                    </tr>
                </tbody>
            </Table>
        </DivFlexCol>
        <div class="flex items-center justify-end gap-2">
            <Component
                v-for="link in orders.links"
                :is="link.url ? 'Link' : 'span'"
                :href="link.url"
                v-html="link.label"
                class="px-3 py-1 border border-gray-200 text-primary-font font-bold rounded-lg"
                :class="{
                    'bg-primary text-white': link.active,
                    'hover:bg-primary/50 transition-colors transition-duration duration-300':
                        link.url,
                }"
            />
        </div>
    </Layout>
</template>

<!-- <Dialog v-model:open="visible">
    <DialogContent class="sm:max-w-[600px]">
        <DialogHeader>
            <DialogTitle>Upload SO Header</DialogTitle>
            <DialogDescription>
                Input all the important fields.
            </DialogDescription>
        </DialogHeader>
        <div class="space-y-5">
            <div class="space-y-1">
                <Label>Store</Label>
                <Select v-model="form.store">
                    <SelectTrigger>
                        <SelectValue placeholder="Select Store" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Select Store</SelectLabel>
                            <SelectItem
                                v-for="(value, key) in branches"
                                :key="key"
                                :value="key"
                            >
                                {{ value }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
                <FormError>{{ form.errors.store }}</FormError>
            </div>
            <div class="flex flex-col space-y-1">
                <Label>SO Date</Label>
                <Input type="date" v-model="form.store_order_date" />
                <FormError>{{
                    form.errors.store_order_date
                }}</FormError>
            </div>
            <div class="flex flex-col space-y-1">
                <Label>Orders</Label>
                <Input
                    type="file"
                    @input="form.orders_list = $event.target.files[0]"
                />
                <FormError>{{ form.errors.orders_list }}</FormError>
            </div>
            <div class="flex flex-col space-y-1">
                <Label>Orders Templates</Label>
                <ul>
                    <li>
                        GSI BAKERY:
                        <a
                            class="text-blue-500 underline"
                            href="/excel/gsi-bakery-template"
                            >Click to download</a
                        >
                    </li>
                    <li>
                        GSI PR:
                        <a
                            class="text-blue-500 underline"
                            href="/excel/gsi-pr-template"
                            >Click to download</a
                        >
                    </li>
                    <li>
                        PUL:
                        <a
                            class="text-blue-500 underline"
                            href="/excel/pul-template"
                            >Click to download</a
                        >
                    </li>
                </ul>
            </div>
        </div>
        <DialogFooter>
            <Button @click="proceed" type="submit"> Proceed </Button>
        </DialogFooter>
    </DialogContent>
</Dialog> -->
