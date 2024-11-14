<script setup>
import { MagnifyingGlassIcon } from "@radix-icons/vue";
import { ref } from "vue";
const search = ref(null);
const statusBadgeColor = (status) => {
    switch (status) {
        case "RECEIVED":
            return "bg-green-500 text-white";
        case "PENDING":
            return "bg-yellow-500 text-white";
        case "INCOMPLETE":
            return "bg-orange-500 text-white";
        default:
            return "bg-yellow-500 text-white";
    }
};
import { Badge } from "@/components/ui/badge";

const props = defineProps({
    orders: {
        type: Object,
    },
    orderDetails: {
        type: Object,
    },
});

const { SONumber, SODate, STATUS, SOApproved } = props.orderDetails[0];
</script>

<template>
    <Layout heading="Order Details">
        <DivFlexCol
            class="p-5 w-[700px] h-full rounded-lg border border-gray/20 space-y-5"
        >
            <DivFlexCenter class="gap-5">
                <span class="text-gray-700 text-sm">
                    Order Number: <span class="font-bold"> {{ SONumber }}</span>
                </span>
                <span class="text-gray-700 text-sm">
                    Order Date: <span class="font-bold"> {{ SODate }}</span>
                </span>
                <span class="text-gray-700 text-sm">
                    Status:
                    <Badge :class="statusBadgeColor(STATUS)">
                        {{ STATUS }}
                    </Badge>
                </span>
            </DivFlexCenter>
            <DivFlexCenter class="justify-between">
                <!-- Search Bar-->
                <div class="relative w-full max-w-sm items-center">
                    <Input
                        v-model="search"
                        id="search"
                        type="text"
                        placeholder="Item Search"
                        class="pl-10"
                    />
                    <span
                        class="absolute start-0 inset-y-0 flex items-center justify-center px-2"
                    >
                        <MagnifyingGlassIcon
                            class="size-6 text-muted-foreground"
                        />
                    </span>
                </div>
            </DivFlexCenter>

            <Table>
                <thead>
                    <tr>
                        <TH>Item</TH>
                        <TH>Code</TH>
                        <TH>Unit</TH>
                        <TH>Quantity</TH>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-for="order in orders" :key="order.id">
                        <TD>{{ order.InventoryName }}</TD>
                        <TD>{{ order.ItemCode }}</TD>
                        <TD>{{ order.UOM_Desc }}</TD>
                        <TD>{{ order.PO_QTY }}</TD>
                    </tr>
                </tbody>
            </Table>
            <!-- <div
                v-if="orders.data.length === 0"
                class="p-5 flex justify-center w-full"
            >
                No Result Found
            </div>
            <div
                v-if="orders.data.length !== 0"
                class="flex items-center justify-end gap-2"
            >
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
            </div> -->
        </DivFlexCol>
    </Layout>
</template>
