<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import Layout from "@/Layouts/App.vue";
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Badge } from "@/components/ui/badge";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
    store: null,
    store_order_date: new Date().toISOString().slice(0, 10),
    orders_list: null,
});

const proceed = () => {
    console.log(form);
};

import { ref } from "vue";

const visible = ref(false);
const handleClick = () => {
    visible.value = true;
};

const props = defineProps({
    orders: {
        type: Object,
    },
    branches: {
        type: Object,
    },
    vendors: {
        type: Object,
    },
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
        <Card>
            <CardHeader>
                <CardDescription
                    >Recent transactions from your orders.</CardDescription
                >
            </CardHeader>
            <CardContent>
                <Table>
                    <TableCaption>A list of your recent orders.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead> Id </TableHead>
                            <TableHead> Vendor</TableHead>
                            <TableHead> Store</TableHead>
                            <TableHead> Order Placed At</TableHead>
                            <TableHead> Order # </TableHead>
                            <TableHead> Order Date </TableHead>
                            <TableHead> Order Items </TableHead>
                            <TableHead> Order Quantity </TableHead>
                            <TableHead> Receiving Status </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="order in orders" :key="order.id">
                            <TableCell>{{ order.Id }}</TableCell>
                            <TableCell>{{ order.vendor.Name }}</TableCell>
                            <TableCell>{{ order.branch.Name }}</TableCell>
                            <TableCell>{{ order.created_at }}</TableCell>
                            <TableCell>{{ order.SONumber }}</TableCell>
                            <TableCell>{{ order.OrderDate }}</TableCell>
                            <TableCell>{{ order.Total_Item }}</TableCell>
                            <TableCell>{{
                                order.TOTALQUANTITY ?? 0
                            }}</TableCell>
                            <TableCell>
                                <Badge :class="statusClass(order.Status)">{{
                                    order.Status
                                }}</Badge>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>

        <Dialog v-model:open="visible">
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
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label>SO Date</Label>
                        <Input type="date" v-model="form.store_order_date" />
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label>Orders</Label>
                        <Input
                            type="file"
                            @input="form.orders_list = $event.target.files[0]"
                        />
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
        </Dialog>
    </Layout>
</template>
