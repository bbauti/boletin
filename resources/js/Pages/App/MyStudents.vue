<script setup>

// TODO: agregar paginacion

import { Head } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { toRaw } from 'vue';

const { users, courses } = defineProps({ users: Object, courses: Object })

const usersArray = toRaw(users)
const coursesArray = toRaw(courses)

let isChecked = false;

const changeCourse = (e) => {
    const courseId = parseInt(e.target.value)
    const userId = parseInt(e.target.dataset.user)
    const data = {
        course: courseId,
    }
    axios.put(`/api/users/${userId}/update-course`, data)
    .then(function (response) {
        const updatedUser = usersArray.find(user => user.id === userId)
        if (response.data.type === 'remove') {
            toast.warning(`Se removio al alumno ${updatedUser.name} de su curso.`);
        } else {
            const updatedCourse = coursesArray.find(course => course.id === courseId)
            toast.success(`Se le asigno el curso ${updatedCourse.course_name} al alumno ${updatedUser.name}.`);
        }
    })
    .catch(function (error) {
        console.log(error);
    });
}

/* const changeRole = (e) => {
    const role = parseInt(e.target.value)
    const userId = parseInt(e.target.dataset.user)
    const data = {
        role: role,
    }
    axios.put(`/api/users/${userId}/update-role`, data)
    .then(function (response) {
        const updatedUser = usersArray.find(user => user.id === userId)
        toast.warning(`Se modifico el rol del usuario ${updatedUser.name}.`);
    })
    .catch(function (error) {
        console.log(error);
    });
} */

const checkAll = (e) => {
    const inputs = document.querySelectorAll('input[type="checkbox"]:not(#mainCheckbox)')
    isChecked = e.target.checked
    inputs.forEach(input => {
        input.checked = isChecked
    });
}

const unCheck = () => {
    document.querySelector('#mainCheckbox').checked = false
}

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
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" @change="checkAll" id="mainCheckbox" />
                        </label>
                        </th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <!-- <th>Rol</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" :checked="isChecked" @change="unCheck" />
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
                            <select @change="changeCourse" :data-user="user.id" name="course" id="course" class="select select-bordered">
                                <option value="0">Curso</option>
                                <option v-for="course in courses" :value="course.id" :selected="user.course_id === course.id">{{ course.course_name }}</option>
                            </select>
                        </td>
                        <!-- <td>
                            <select @change="changeRole" :data-user="user.id" name="course" id="course" class="select select-bordered">
                                <option value="student" :selected="user.role === 'student'">Estudiante</option>
                                <option value="teacher" :selected="user.role === 'teacher'">Profesor {{ user.role }}</option>
                            </select>
                        </td> -->
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
