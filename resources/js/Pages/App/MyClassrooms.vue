<script setup>

// TODO: agregar paginacion

import { Head } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { toRaw } from 'vue';

const classrooms = defineProps({ classrooms: Object })

const classroomsArray = toRaw(classrooms)

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
    <Head title="Mis Cursos" />
    <div class="py-12">
        <p class="mb-5">Aulas</p>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" @change="checkAll" id="mainCheckbox" />
                        </label>
                        </th>
                        <th>Aula</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="classroom in classrooms">
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" :checked="isChecked" @change="unCheck" />
                        </label>
                        </th>
                        <td>
                        <div class="flex items-center gap-3">
                            <div class="font-bold">{{ classroom.classroom_name }}</div>
                        </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Aula</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>
