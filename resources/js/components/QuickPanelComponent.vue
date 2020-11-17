<template>
    <div class="p-4">
        <h4 class="kt-heading kt-heading--sm kt-heading--space-sm mb-4">Filter contacts by</h4>

        <div class="form-group">
            <select v-model="filter_dropdown" class="form-control">
                <option :value="index" v-for="(filter,index) in availableFilters">
                    {{ filter.label }}
                </option>
            </select>

            <button @click.prevent="addFilter" type="button" class="mt-4 btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Add Filter</button>
        </div>

        <div class="mt-4" v-if="activeFilters.length > 0">
            <hr>
            <h5 class="kt-heading kt-heading--sm kt-heading--space-sm mt-5 mb-4">Active Filters ({{ activeFilters.length }} applied)</h5>
            <div @mouseover="mouseover = index" @mouseleave="mouseover = null" class="form-group" v-for="(filter, index) in activeFilters" :key="'fg' + index">
                <div class="d-flex justify-content-between">
                    <label>{{ filter.label }}</label>
                    <a href="#" @click.prevent="removeFilter(filter, index)" v-if="mouseover === index">Remove</a>
                </div>
<!--                 <multiselect v-model="activeFilters[index].selectedOption" :options="activeFilters[index].options" :multiple="false" :close-on-select="true" :preselect-first="true"></multiselect>-->
                <select class="form-control" v-model="activeFilters[index].selectedOption">
                    <option v-for="(option, index) in activeFilters[ index ].options" :key="'fc' + index">
                        {{ option }}
                    </option>
                </select>


                <div v-if="activeFilters[index].type === 'dropdown'">
                    <select class="form-control" v-model="activeFilters[index].selectedValue">
                        <option :value="value.name" v-for="(value, index) in activeFilters[index].values" :key="'dr' + index">
                            {{ value.label }}
                        </option>
                    </select>
<!--                    <multiselect @select="updateFilters" v-model="activeFilters[index].selectedValue" :options="activeFilters[index].values" label="label" track-by="name" :multiple="false" :close-on-select="true" :preselect-first="true"></multiselect>-->
                </div>

                <div v-else-if="activeFilters[index].type === 'number'">
                    <input class="form-control" type="number" @input="updateFilters" v-model="activeFilters[index].selectedValue">
                </div>

                <div v-else-if="activeFilters[index].type === 'text'">
                    <input class="form-control" type="text" @input="updateFilters" v-model="activeFilters[index].selectedValue">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Router from 'vue-router';

    export default {
        name: 'quick-panel',
        mounted() {
            let _this = this;

            this.$root.$on( 'gpsd:update-page', page_id => {
                _this.page = page_id;
            });

            this.router = new Router( {
                routes: []
            } );

            this.local_filters = this.filters;
        },

        props: [ 'filters' ],

        data() {
            return {
                page: null,

                // Required variables for filtering...
                router: null,
                show_filters_pane: false,
                filter_dropdown: [],
                activeFilters: [],
                isLoading: false,
                timeout: null,
                debounceDelay: 1000,

                mouseover: null,

                local_filters: [],
            }
        },

        /**
         * Computed properties for filtering
         */
        computed: {
            availableFilters: {
                get() {
                    return this.local_filters.filter( function ( item ) {
                        return !item.selected;
                    } );
                }
            },
            applicableFilters: {
                get() {
                    return this.local_filters.filter( function ( item ) {
                        return item.selected;
                    } );
                }
            }
        },

        /**
         * Methods for filtering
         */
        methods: {
            addFilter() {
                let filter_object = this.availableFilters[ this.filter_dropdown ];

                this.activeFilters.push( filter_object );

                for ( let filter of this.local_filters ) {
                    if ( filter.name === filter_object.name ) {
                        filter.selected = true;
                    }
                }

                this.filter_dropdown = null;
            },

            removeFilter( filter_object, index ) {
                let _this = this;

                for ( let filter of this.local_filters ) {
                    if ( filter.name === filter_object.name ) {
                        filter.selected = false;
                        filter.selectedOption = null;
                        filter.selectedValue = null;
                    }
                }

//                // delete from active filters
                this.activeFilters.splice( index, 1 );
//
                this.$nextTick( () => {
                    _this.updateFilters();
                });
            },

            updateFilters() {
                let that = this;

                if ( this.timeout ) {
                    clearTimeout( this.timeout );
                }

                this.timeout = setTimeout( function () {
                    let filters = {};

                    for ( let filter of that.activeFilters ) {
                        filters[ filter.name + '[option]' ] = filter.selectedOption;
                        filters[ filter.name + '[value]' ] = filter.selectedValue;
                    }

                    console.log( filters );

                    that.router.push( { query: { ...filters } } );

                    /**
                     * Send off request for new information
                     */
                    that.isLoading = true;

                    axios.get( "/api/contacts", {
                        params: that.router.currentRoute.query
                    } ).then( function ( response ) {
                        that.$root.$emit( 'gpsd:refresh-datatable', response.data.data );
                        that.isLoading = false;
                    } );
                }, this.debounceDelay );
            }
        }
    }
</script>
