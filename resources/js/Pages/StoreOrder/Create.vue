<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
    CardFooter,
} from "@/components/ui/card";
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

const invoices = [
    {
        invoice: "INV001",
        paymentStatus: "Paid",
        totalAmount: "$250.00",
        paymentMethod: "Credit Card",
    },
    {
        invoice: "INV002",
        paymentStatus: "Pending",
        totalAmount: "$150.00",
        paymentMethod: "PayPal",
    },
    {
        invoice: "INV003",
        paymentStatus: "Unpaid",
        totalAmount: "$350.00",
        paymentMethod: "Bank Transfer",
    },
    {
        invoice: "INV004",
        paymentStatus: "Paid",
        totalAmount: "$450.00",
        paymentMethod: "Credit Card",
    },
    {
        invoice: "INV005",
        paymentStatus: "Paid",
        totalAmount: "$550.00",
        paymentMethod: "PayPal",
    },
    {
        invoice: "INV006",
        paymentStatus: "Pending",
        totalAmount: "$200.00",
        paymentMethod: "Bank Transfer",
    },
    {
        invoice: "INV007",
        paymentStatus: "Unpaid",
        totalAmount: "$300.00",
        paymentMethod: "Credit Card",
    },
];
</script>

<template>
    <Layout heading="Store Order > Create">
        <div class="grid grid-cols-3 gap-5">
            <Card>
                <CardHeader>
                    <CardTitle>Add Item</CardTitle>
                    <CardDescription>SO Number: NNABA-0001</CardDescription>
                </CardHeader>
                <CardContent class="space-y-3">
                    <div class="flex flex-col space-y-1">
                        <Label>SO Date</Label>
                        <Input type="date" />
                    </div>
                    <div class="space-y-1">
                        <Label>Item</Label>
                        <Select>
                            <SelectTrigger>
                                <SelectValue placeholder="Select Item" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Select Store</SelectLabel>
                                    <SelectItem value="apple">
                                        Apple
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label>Unit Of Measurement (UOM)</Label>
                        <Input type="text" disabled />
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label>Quantity</Label>
                        <Input type="number" />
                    </div>
                </CardContent>

                <CardFooter class="flex justify-end">
                    <Button>Add to Orders</Button>
                </CardFooter>
            </Card>
            <Card class="col-span-2">
                <CardHeader>
                    <CardTitle>Your Orders</CardTitle>
                    <CardDescription>Items on your order list.</CardDescription>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[100px]">
                                    Invoice
                                </TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>Method</TableHead>
                                <TableHead class="text-right">
                                    Amount
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="invoice in invoices"
                                :key="invoice.invoice"
                            >
                                <TableCell class="font-medium">
                                    {{ invoice.invoice }}
                                </TableCell>
                                <TableCell>{{
                                    invoice.paymentStatus
                                }}</TableCell>
                                <TableCell>{{
                                    invoice.paymentMethod
                                }}</TableCell>
                                <TableCell class="text-right">
                                    {{ invoice.totalAmount }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </Layout>
</template>
