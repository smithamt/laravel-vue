<template>
    <div class="w-full h-full">
        <div class="flex">
            <aside>
                <ul>
                    <li>
                        <router-link to="/app/organization/departments" active-class="active-link">Departments</router-link>
                    </li>
                    <li>
                        <router-link to="/app/organization/leaves" active-class="active-link">Leaves</router-link>
                    </li>
                    <!-- Add more links as needed -->
                </ul>
            </aside>
            <!-- This is where child components will be rendered -->
            <router-view class="flex-1"></router-view>
            <h1>I'm an Organization component from Vue.</h1>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Organization Component mounted.");
    },
};
</script>

<style>
/* Add your custom styles for the active link here */
.active-link {
    font-weight: bold;
    color: #007bff;
}
</style>
