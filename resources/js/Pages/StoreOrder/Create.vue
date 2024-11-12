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
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from "@/components/ui/dialog";
import FormError from "@/Components/FormError.vue";

const props = defineProps({
    products: {
        type: Object,
        required: false,
    },
});

import { ref, reactive, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

const productId = ref(null);
const itemDetails = ref(null);
const orderDate = ref(props.orderDate);
const unitOfMeasurment = ref(null);
const visible = ref(false);

const productDetails = reactive({
    item_code: null,
    item_name: null,
    unit: null,
    quantity: null,
});

const form = useForm({
    orders_file: null,
});

// Nat - (This function will just check if the value item select changed to set the UOM accordingly)
watch(productId, (newValue) => {
    if (newValue) {
        axios
            .get(route("product.show", newValue))
            .then((response) => response.data)
            .then((result) => {
                itemDetails.value = result;
                unitOfMeasurment.value = result.Packaging;
                productDetails.item_name = result.InventoryName;
                productDetails.item_code = result.InventoryID;
                productDetails.unit = result.Packaging;
            })
            .catch((err) => console.log(err));
    }
});

const importOrdersButton = () => {
    visible.value = true;
};

const orders = ref([]);

const addToOrdersButton = () => {
    orders.value.push({ ...productDetails });
};

// Nat - (getting the imported data)
const proceedButton = () => {
    const formData = new FormData();
    formData.append("orders_file", form.orders_file);

    axios
        .post(route("store-orders.imported-file"), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then((response) => {
            orders.value = [...orders.value, ...response.data.orders];
            visible.value = false;
        })
        .catch((error) => {
            form.setError("orders_file", error.response.data.message);
        });
};
</script>

<template>
    <Layout
        heading="Store Order > Create"
        :hasButton="true"
        buttonName="Import Orders"
        :handleClick="importOrdersButton"
    >
        <div class="grid grid-cols-3 gap-5">
            <Card>
                <CardHeader>
                    <CardTitle>Add Item</CardTitle>
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
                            v-model="productDetails.unit"
                        />
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label>Quantity</Label>
                        <Input
                            type="number"
                            v-model="productDetails.quantity"
                        />
                    </div>
                </CardContent>

                <CardFooter class="flex justify-end">
                    <Button @click="addToOrdersButton">Add to Orders</Button>
                </CardFooter>
            </Card>
            <Card class="col-span-2">
                <CardHeader>
                    <CardTitle>Your Orders</CardTitle>
                    <CardDescription>SO Number: NNABA-0001</CardDescription>
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

        <Dialog v-model:open="visible">
            <DialogContent class="sm:max-w-[600px]">
                <DialogHeader>
                    <DialogTitle>Import Orders</DialogTitle>
                    <DialogDescription>
                        Import the excel file of your orders.
                    </DialogDescription>
                </DialogHeader>
                <div class="space-y-5">
                    <div class="flex flex-col space-y-1">
                        <Label>Orders</Label>
                        <Input
                            type="file"
                            @input="form.orders_file = $event.target.files[0]"
                        />
                        <FormError>{{ form.errors.orders_file }}</FormError>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <Label class="text-xs">Order Templates</Label>
                        <ul>
                            <li class="text-xs">
                                GSI BAKERY:
                                <a
                                    class="text-blue-500 underline"
                                    href="/excel/gsi-bakery-template"
                                    >Click to download</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <DialogFooter>
                    <Button @click="proceedButton" type="submit">
                        Proceed
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </Layout>
</template>
