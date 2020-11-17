<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                <span v-if="$parent.active_record">
                    Editing @{{ form.name }}
                </span>
                <span v-else>
                    Create New Project Type
                </span>
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <div class="kt-portlet__body">
        <div class="row">
            <div class="mt-3 col-12" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid}">
                <label class="form-check-label" for="name">
                    {{ trans('admin.project-type.columns.name') }}
                </label>

                <input type="text" v-model="form.name" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid }" id="name" name="name" placeholder="{{ trans('admin.project.columns.name') }}">
                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-4 mb-4">
                <h4 class="d-inline-block kt-subheader__title">
                    {{ trans('admin.project-type.labels.materials') }}
                </h4>

                <button @click.prevent="copyToSpecs" class="btn ml-2 btn-sm btn-primary"><i class="fa fa-copy"></i>
                    {{ trans('admin.project-type.labels.copy-to-specs') }}
                </button>
            </div>
            <div class="col-4 mb-4">
                <h4 class="d-inline-block kt-subheader__title">
                    {{ trans('admin.project-type.labels.specs') }}
                </h4>
            </div>
        </div>

        <div class="row mt-3">
            <draggable
                    class="col-4 pr-0 bg-gray-100 accordion border-right list-group"
                    :list="materialFields"
                    group="people"
            >
                <div v-for="(element,index) in materialFields" :key="element.id">

                    <div :id="'heading' + index">
                        <div @click="leftFocusedID = element.id" class="b-r-0 list-group-item" data-toggle="collapse" :data-target="'#collapse' + index" :aria-controls="'collapse' + index" aria-expanded="true">
                            Type: @{{ element.type }}, Label: @{{ element.name }}

                        </div>
                    </div>

                    <div :id="'collapse' + index" class="collapse" :class="leftFocusedID === element.id ? 'show' : ''" :aria-labelledby="'heading' + index" data-parent="#accordionExample">
                        <div class="card-body">
                            <label>Field Label:</label>
                            <input class="form-control" v-model="element.name" type="text">

                            <div v-if="element.type === 'select'" class="form-row">
                                <label>Options:</label>
                                <textarea class="form-control" placeholder="Options allowed. Start each entry on a new line." v-model="element.options"></textarea>
                            </div>

                            <a @click="remove(index, 'left')">Remove</a>
                        </div>
                    </div>
                </div>
            </draggable>

            <draggable
                    class="col-4 pr-0 bg-gray-100 accordion list-group"
                    :list="specFields"
                    group="people"
            >
                <div v-for="(element,index) in specFields" :key="element.id">

                    <div :id="'heading' + index">
                        <div @click="leftFocusedID = element.id" class="list-group-item b-l-0" data-toggle="collapse" :data-target="'#collapse' + index" :aria-controls="'collapse' + index" aria-expanded="true">
                            Type: @{{ element.type }}, Label: @{{ element.name }}
                        </div>
                    </div>

                    <div :id="'collapse' + index" class="collapse" :class="leftFocusedID === element.id ? 'show' : ''" :aria-labelledby="'heading' + index" data-parent="#accordionExample">
                        <div class="card-body">
                            <label>Field Label:</label>
                            <input class="form-control" v-model="element.name" type="text">

                            <div v-if="element.type === 'select'" class="form-row">
                                <label>Options:</label>
                                <textarea class="form-control" placeholder="Options allowed. Start each entry on a new line." v-model="element.options"></textarea>
                            </div>

                            <a @click="remove(index, 'right')">Remove</a>
                        </div>
                    </div>
                </div>
            </draggable>


            <div class="col-4">
                <ul class="list-group">
                    <li class="list-group-item active">Elements</li>
                    <draggable
                            class="dragArea list-group"
                            :list="list1"
                            :group="{ name: 'people', pull: 'clone', put: false }"
                            :clone="cloneDog"
                    >
                        <div class="list-group-item" v-for="element in list1" :key="'fields_' + element.id">
                            <i :class="'fa fa-' + element.icon"></i> @{{ element.name }}
                        </div>

                        {{--                <li class="list-group-item test" key="text" style="cursor:pointer;">--}}
                        {{--                    <i class="fa fa-pencil-square-o mr-2"></i> Text Input--}}
                        {{--                </li>--}}
                        {{--                <li class="list-group-item" key="number" style="cursor:pointer;">--}}
                        {{--                    <i class="fa fa-calculator mr-2"></i> Number Input--}}
                        {{--                </li>--}}
                        {{--                <li class="list-group-item" key="date" style="cursor:pointer;">--}}
                        {{--                    <i class="fa fa-calendar mr-2"></i> Date Picker--}}
                        {{--                </li>--}}
                        {{--                <li class="list-group-item" key="select" style="cursor:pointer;">--}}
                        {{--                    <i class="fa fa-database mr-2"></i> Select Input--}}
                        {{--                </li>--}}
                        {{--                <li class="list-group-item" key="checkbox" style="cursor:pointer;">--}}
                        {{--                    <i class="fa fa-check-square-o mr-2"></i> Check Box--}}
                        {{--                </li>--}}
                    </draggable>
                </ul>
            </div>
        </div>
    </div>

</div>

{{--<form-builder type="template"></form-builder>--}}