<template>
    <v-stage :config="configKonva">
        <v-layer>
            <v-circle :config="configCircle"></v-circle>
        </v-layer>
    </v-stage>
</template>
<script>
export default {
    data : function(){
        return {
            configKonva:{
                width: 500,
                height: 500
            },
            configCircle: {
                x: 100,
                y: 100, 
                radius: 70,
                fill: 'red',
                stroke: 'blue',
                strokeWidth: 4
            }
        }
    }
}
</script>
