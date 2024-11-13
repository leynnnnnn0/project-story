<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
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

const props = defineProps({
    orders: {
        type: Object,
    },
});
</script>
<template>
    <Layout heading="Orders For Approval List">
        <Card>
            <CardHeader>
                <CardDescription
                    >Recent transactions from your orders.</CardDescription
                >
            </CardHeader>
            <CardContent>
                <Table>
                    <TableCaption>A list of orders for approval.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead> Order Placed At </TableHead>
                            <TableHead> SO Date</TableHead>
                            <TableHead> SO Number</TableHead>
                            <TableHead> Total Item</TableHead>
                            <TableHead> Total Quantity </TableHead>
                            <TableHead> Created By</TableHead>
                            <TableHead> Vendor </TableHead>
                            <TableHead> Branch </TableHead>
                            <TableHead> Status </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody v-for="order in orders">
                        <TableCell>{{ order.OrderDate }}</TableCell>
                        <TableCell>{{ order.SODate }}</TableCell>
                        <TableCell>{{ order.SONumber }}</TableCell>
                        <TableCell>{{ order.TOTAL_ITEM }}</TableCell>
                        <TableCell>{{ order.TotalQuantity }}</TableCell>
                        <TableCell>{{ order.CreatedBy }}</TableCell>
                        <TableCell>{{ order.Vendor }}</TableCell>
                        <TableCell>{{ order.Branch }}</TableCell>
                        <TableCell>{{ order.STATUS }}</TableCell>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </Layout>
</template>
