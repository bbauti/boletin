<script setup>

// TODO: agregar paginacion

import { Head, router } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
import { ref } from 'vue';
import { Icon } from "@iconify/vue";
import DialogModal from '@/Components/DialogModal.vue';

defineProps({ classrooms: Object })

let isChecked = false;

const editRow = (classroom) => {
    if (classroom.isEditing) {
        const data = {
            classroom_name: classroom.classroom_name,
        }
        // TODO: controlar duplicacion en el frontend
        axios.put(`/api/classrooms/update-classroom/${classroom.id}`, data)
        .then(function (response) {
            if (response.data.status !== 'duplicated') {
                toast.success(`Se modifico el aula ${data.classroom_name}.`);
                router.reload({ only: ['classrooms'] })
            }
        })
        .catch(function (error) {
            console.log(error);
        });
        classroom.isEditing = !classroom.isEditing
        return
    }
    classroom.isEditing = !classroom.isEditing
}

const deleteRow = (classroomId) => {
    document.querySelector(`#modal${classroomId}`).showModal()
    isModalOpen = true
}

const confirmDelete = (classroom) => {
    axios.delete(`/api/classroomss/${classroom.id}/delete-classroom`)
    .then(function (response) {
        toast.warning(`Se elimino el curso ${classroom.classroom_name}.`);
    })
    .catch(function (error) {
        console.log(error);
    });
    document.querySelector(`#modal${classroom.id}`).close()
    classroom.isEditing = !classroom.isEditing
    router.reload({ only: ['classrooms'] })
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
            <table class="table max-w-xs">
                <thead>
                    <tr>
                        <th>
                        <label>
                            <input type="checkbox" class="checkbox" @change="checkAll" id="mainCheckbox" />
                        </label>
                        </th>
                        <th>Aula</th>
                        <th>Acciones</th>
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
                                <input class="input" :class="classroom.isEditing ? 'input-bordered' : 'input-ghost pointer-events-none'" :style="`width: ${classroom.classroom_name.length+4}ch`" type="text" v-model="classroom.classroom_name">
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row-reverse">
                                <button class="!p-2 w-fit btn btn-square transiton-all ease-in-out" :class="classroom.isEditing ? 'btn-success' : 'btn-ghost'" @click="editRow(classroom)">
                                    <Icon
                                        class="text-xl"
                                        :icon="classroom.isEditing ? 'bxs:save' : 'clarity:pencil-solid'"
                                    />
                                </button>
                                <button class="!p-2 w-fit btn btn-square mr-2 transiton-all ease-in-out" :class="classroom.isEditing ? 'btn-error' : 'btn-ghost invisible'" @click="deleteRow(classroom.id)">
                                    <Icon
                                        class="text-xl"
                                        icon="iconamoon:trash-fill"
                                    />
                                </button>
                                <!-- TODO: Hacer dinamico -->
                                <dialog :id="`modal${classroom.id}`" class="modal modal-bottom sm:modal-middle">
                                    <div class="modal-box">
                                        <h3 class="font-bold text-lg">Seguro que desea eliminar esta aula?</h3>
                                        <p class="pt-4">Eliminar esta aula eliminara los cursos que la usen, y eliminara de esos cursos a los usuarios que formen parte de ellos</p>
                                        <p class="py-2 pb-4 text-error">Esta accion no es reversible</p>
                                        <div class="modal-action flex justify-between">
                                        <button class="btn btn-error" @click="confirmDelete(classroom)">Eliminar curso</button>
                                            <form method="dialog">
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
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>
