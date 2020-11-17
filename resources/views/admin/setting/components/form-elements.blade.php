<div class="form-group input-group">
    <input @submit.prevent="addTag" type="text" class="form-control form-control-lg" v-model="tag" placeholder="Item to add">
    <div class="input-group-prepend">
        <button type="button" @click.prevent="addTag" class="btn btn-primary">Add</button>
    </div>
</div>

<slick-list lockAxis="y" v-model="items">
    <slick-item v-for="(item, index) in items" :index="index" :key="index">
        <div class="collapse multi-collapse show pointer-event">
            <div class="card card-body">
                @{{ item }}
            </div>
        </div>
    </slick-item>
</slick-list>