<script setup>

// TODO: agregar paginacion

import { Head, router } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { toRaw, ref } from 'vue';
import { Icon } from "@iconify/vue";
import DialogModal from '@/Components/DialogModal.vue';
import Swal from 'sweetalert2'

const { users, courses, classrooms } = defineProps({ users: Object, courses: Object, classrooms: Object })

const usersArray = ref(toRaw(users))
const coursesArray = ref(toRaw(courses))
const classroomsArray = ref(toRaw(classrooms))

const displayingCourse = ref(false);

let isChecked = false;

const editRow = (course) => {
    if (course.isEditing) {
        console.log('guardar')
        course.isEditing = !course.isEditing
        return
    }
    const currentEditing = courses.find(course => course.isEditing === true)
    course.isEditing = !course.isEditing
}

const deleteRow = (courseId) => {
    console.log('hola')
    document.querySelector(`#modal${courseId}`).showModal()
    isModalOpen = true
}

const confirmDelete = (course) => {
    axios.delete(`/api/courses/${course.id}/delete-course`)
    .then(function (response) {
        toast.warning(`Se elimino el curso ${course.course_name}.`);
    })
    .catch(function (error) {
        console.log(error);
    });
    document.querySelector(`#modal${course.id}`).close()
    course.isEditing = !course.isEditing
    router.reload({ only: ['courses'] })
}

const createCourse = () => {
    const form = document.querySelector('#createCourseForm')
    const data = {
        course_name: form.querySelector('#course_name').value,
        academic_year: parseInt(form.querySelector('#academic_year').value),
        in_charge: parseInt(form.querySelector('#in_charge').value),
        assigned_classroom: parseInt(form.querySelector('#assigned_classroom').value),
    }
    console.log(data)
    axios.post(`/api/courses/create-course`, data)
    .then(function (response) {
        toast.warning(`Se creo el curso ${data.course_name}.`);
        router.reload({ only: ['courses'] })
        displayingCourse.value = false
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
        <p class="mb-5">Cursos</p>
        <div class="overflow-x-auto">
            <button class="btn btn-accent mb-5" @click="displayingCourse = true">Agregar nuevo curso</button>
            <DialogModal :show="displayingCourse" @close="displayingCourse = false" class="w-fit">
                <template #title>
                    Crear nuevo curso
                </template>

                <template #content>
                    <div class="">
                        <form class="flex gap-5" id="createCourseForm">
                            <div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Nombre</span>
                                    </label>
                                    <input type="text" id="course_name" class="input input-bordered w-full max-w-xs" />
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">A cargo</span>
                                    </label>
                                    <select id="in_charge" class="select select-bordered" >
                                        <option v-for='user in usersArray' :value="user.id">{{ user.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Año</span>
                                    </label>
                                    <input type="number" id="academic_year" class="input input-bordered w-full max-w-xs" />
                                </div>
                                <div class="form-control w-full max-w-xs">
                                    <label class="label">
                                        <span class="label-text">Aula</span>
                                    </label>
                                    <select id="assigned_classroom" class="select select-bordered">
                                        <option v-for='classroom in classroomsArray' :value="classroom.id">{{ classroom.classroom_name }}</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </template>

                <template #footer>
                    <div class="w-full flex justify-between">
                        <button class="btn btn-success" @click="createCourse">Crear curso</button>
                        <button class="btn btn-off" @click="displayingCourse = false">Cancelar</button>
                    </div>
                </template>
            </DialogModal>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" @change="checkAll" id="mainCheckbox" />
                        </label>
                        </th>
                        <th>Curso</th>
                        <th>En cargo</th>
                        <th>Año</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                        <!-- <th>Rol</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses">
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" :checked="isChecked" @change="unCheck" />
                        </label>
                        </th>
                        <td>
                        <div class="flex items-center gap-3">
                            <input class="input" :class="course.isEditing ? 'input-bordered' : 'input-ghost pointer-events-none'" :style="`width: ${course.course_name.length+4}ch`" type="text" :value="course.course_name">
                        </div>
                        </td>
                        <td>
                            <select class="select" :class="course.isEditing ? 'select-bordered' : 'select-ghost pointer-events-none bg-none'" >
                                <option v-for='user in usersArray' :selected="user.id === course.in_charge" :value="user.id">{{ user.name }}</option>
                            </select>
                        </td>
                        <td>
                            <input class="input" :class="course.isEditing ? 'input-bordered' : 'input-ghost pointer-events-none'" :style="`width: ${course.academic_year.toString().length+4}ch`" type="text" :value="course.academic_year">
                        </td>
                        <td>
                            <select class="select" :class="course.isEditing ? 'select-bordered' : 'select-ghost pointer-events-none bg-none'" >
                                <option v-for='classroom in classroomsArray' :selected="classroom.id === course.assigned_classroom" :value="classroom.id">{{ classroom.classroom_name }}</option>
                            </select>
                        </td>
                        <td>
                            <div class="flex flex-row-reverse">
                                <button class="!p-2 w-fit btn btn-square transiton-all ease-in-out" :class="course.isEditing ? 'btn-success' : 'btn-ghost'" @click="editRow(course)">
                                    <Icon
                                        class="text-xl"
                                        :icon="course.isEditing ? 'bxs:save' : 'clarity:pencil-solid'"
                                    />
                                </button>
                                <button class="!p-2 w-fit btn btn-square mr-2 transiton-all ease-in-out" :class="course.isEditing ? 'btn-error' : 'btn-ghost invisible'" @click="deleteRow(course.id)">
                                    <Icon
                                        class="text-xl"
                                        icon="iconamoon:trash-fill"
                                    />
                                </button>
                                <!-- TODO: Hacer dinamico -->
                                <dialog :id="`modal${course.id}`" class="modal modal-bottom sm:modal-middle">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">Seguro que desea eliminar este curso?</h3>
                                        <p class="py-4">Esta accion no es reversible</p>
                                        <div class="modal-action flex justify-between">
                                        <button class="btn btn-error" @click="confirmDelete(course)">Eliminar curso</button>
                                            <form method="dialog">
                                                <!-- if there is a button in form, it will close the modal -->
                                                <button class="btn btn-off">Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Curso</th>
                        <th>En cargo</th>
                        <th>Año</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>
