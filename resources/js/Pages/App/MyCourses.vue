<script setup>

// TODO: agregar paginacion

import { Head, router } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { ref } from 'vue';
import { Icon } from "@iconify/vue";
import DialogModal from '@/Components/DialogModal.vue';

const { users, courses, classrooms } = defineProps({ users: Object, courses: Object, classrooms: Object })

const displayingCourse = ref(false);

let isChecked = false;

const editRow = (course) => {
    if (course.isEditing) {
        const data = {
            course_name: course.course_name,
            academic_year: parseInt(course.academic_year),
            in_charge: parseInt(course.in_charge),
            assigned_classroom: parseInt(course.assigned_classroom),
        }
        // TODO: controlar duplicacion en el frontend
        axios.put(`/api/courses/update-course/${course.id}`, data)
        .then(function (response) {
            if (response.data.status !== 'duplicated') {
                toast.success(`Se modifico el curso ${data.course_name}.`);
                router.reload({ only: ['courses'] })
            }
        })
        .catch(function (error) {
            console.log(error);
        });
        course.isEditing = !course.isEditing
        return
    }
    course.isEditing = !course.isEditing
}

const deleteRow = (courseId) => {
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
                                        <option v-for='user in users' :value="user.id">{{ user.name }}</option>
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
                                        <option value="">Aula</option>
                                        <option v-for='classroom in classrooms' :value="classroom.id">{{ classroom.classroom_name }}</option>
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
                    <tr v-for="course in courses" :class="course.assigned_classroom === null ? 'bg-error/10' : ''">
                        <th>
                            <label>
                                <input type="checkbox" class="checkbox" :checked="isChecked" @change="unCheck" />
                            </label>
                        </th>
                        <td>
                            <div class="flex items-center gap-3">
                                <input class="input" :class="course.isEditing ? 'input-bordered' : 'input-ghost pointer-events-none'" :style="`width: ${course.course_name.length+4}ch`" type="text" v-model="course.course_name">
                            </div>
                        </td>
                        <td>
                            <select class="select" :class="course.isEditing ? 'select-bordered' : 'select-ghost pointer-events-none bg-none'" v-model="course.in_charge">
                                <option v-for='user in users' :selected="user.id === course.in_charge" :value="user.id">{{ user.name }}</option>
                            </select>
                        </td>
                        <td>
                            <input class="input" :class="course.isEditing ? 'input-bordered' : 'input-ghost pointer-events-none'" :style="`width: ${course.academic_year.toString().length+4}ch`" type="text" v-model="course.academic_year">
                        </td>
                        <td>
                            <select class="select" :class="course.isEditing ? 'select-bordered' : 'select-ghost pointer-events-none bg-none'" v-model="course.assigned_classroom">
                                <option v-for='classroom in classrooms' :selected="classroom.id === course.assigned_classroom" :value="classroom.id">{{ classroom.classroom_name }}</option>
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
