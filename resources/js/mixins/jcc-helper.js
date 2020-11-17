export default {
    computed: {
        indentLevel() {
            let parent = null;
            let count = 0;
            let stop = false;

            while ( !stop ) {
                if ( !parent ) {
                    parent = this.$parent;
                }

                if ( parent.$options.name === 'jcc-form' ) {
                    stop = true;

                    return count;
                }
                else {
                    count++;

                    parent = parent.$parent;
                }
            }
        }
    }
};
