<script setup>
import { Head } from "@inertiajs/vue3";
defineProps({ users: Object, courses: Object })
</script>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    layout: AppLayout,
}
</script>

<template>
    <Head title="Mis Estudiantes" />
    <div class="py-12">
        <p class="mb-5">Estudiantes</p>
        <p>{{ courses }}</p>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" />
                        </label>
                        </th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Curso</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" />
                        </label>
                        </th>
                        <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                                <img :src="user.avatar" alt="Foto de perfil" />
                            </div>
                            </div>
                            <div>
                            <div class="font-bold">{{ user.name }}</div>
                            </div>
                        </div>
                        </td>
                        <td>
                        {{user.email}}
                        </td>
                        <td>
                            <select name="course" id="course" class="select select-bordered">
                                <option value="0">Curso</option>
                                <option v-for="course in courses" :value="course.id" :selected="user.course === course.id">{{ course.course_name }}</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Curso</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>
