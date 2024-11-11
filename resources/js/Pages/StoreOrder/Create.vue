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

const props = defineProps({
    orders: {
        type: Object,
        required: false,
    },
    products: {
        type: Object,
        required: true,
    },
    orderDate: {
        type: String,
        required: true,
    },
});

import { ref, watch } from "vue";

const productId = ref(null);
const itemDetails = ref(null);
const orderDate = ref(props.orderDate);
const unitOfMeasurment = ref(null);
watch(productId, (newValue) => {
    if (newValue) {
        axios
            .get(route("product.show", newValue))
            .then((response) => response.data)
            .then((result) => {
                itemDetails.value = result;
                unitOfMeasurment.value = result.Packaging;
            })
            .catch((err) => console.log(err));
    }
});
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
                        <Input type="date" v-model="orderDate" />
                    </div>
                    <div class="space-y-1">
                        <Label>Item</Label>
                        <Select v-model="productId">
                            <SelectTrigger>
                                <SelectValue placeholder="Select Store" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Select Store</SelectLabel>
                                    <SelectItem
                                        v-for="(value, key) in products"
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
                        <Label>Unit Of Measurement (UOM)</Label>
                        <Input
                            type="text"
                            disabled
                            v-model="unitOfMeasurment"
                        />
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
                                <TableHead> Item </TableHead>
                                <TableHead> Code </TableHead>
                                <TableHead> Unit </TableHead>
                                <TableHead> Quantity </TableHead>
                                <TableHead> Action </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="order in orders"
                                :key="order.item_code"
                            >
                                <TableCell>
                                    {{ order.item_name }}
                                </TableCell>
                                <TableCell>
                                    {{ order.item_code }}
                                </TableCell>
                                <TableCell>
                                    {{ order.unit }}
                                </TableCell>
                                <TableCell>
                                    {{ order.quantity }}
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </Layout>
</template>
