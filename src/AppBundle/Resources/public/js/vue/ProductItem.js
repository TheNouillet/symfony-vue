var ProductItem = Vue.component("product-item", {
    template: "#product-item",
    delimiters: ['${', '}'],
    props: ['product'],
    data: function() {
        return {
            commentCount: null,
            loading: false,
            selected: false
        };
    },
    methods: {
        setCommentCount: function() {
            var that = this;
            that.loading = true;
            axios.get('/comments/' + that.product.id).then(function(response) {
                that.commentCount = response.data.commentCount;
                that.loading = false;
            });
        },
        selectToggle() {
            if(this.selected) {
                this.selected = false;
                this.$emit('removeFromBasket', this.product);
            } else {
                this.selected = true;
                this.$emit('addToBasket', this.product);
            }
        }
    },
    created: function() {
        this.setCommentCount();
    }
});