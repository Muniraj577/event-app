export const ValidationMixins = {
    data: function (){
        return {
            rules: {
                required: value => !!value || 'This field is required',
            }
        }
    }
}
