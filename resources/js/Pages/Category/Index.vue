<script setup>
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import Layout from "@/Layouts/App.vue";
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
    categories: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Layout heading="Categories">
        <Card>
            <CardHeader>
                <CardDescription>List of categories.</CardDescription>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableCaption>A list of your recent orders.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead> Id </TableHead>
                            <TableHead> Module</TableHead>
                            <TableHead> Setting Name</TableHead>
                            <TableHead> Description</TableHead>
                            <TableHead> Value </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="category in categories"
                            :key="category.id"
                        >
                            <TableCell>{{ category.id }}</TableCell>
                            <TableCell>{{ category.CategoryCode }}</TableCell>
                            <TableCell>{{ category.CategoryName }}</TableCell>
                            <TableCell>{{ category.Description }}</TableCell>
                            <TableCell>{{ category.Status }}</TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </Layout>
</template>
