<template>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div  class="m-b-md">
                    <h2 class="title m-b-md">
                        Task Plan
                    </h2>
                    <h3>
                        Your efficent task planner
                    </h3>
                </div>
            </div>
        </div>
    </template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style scoped>
/* .full-height {
  height: 100vh;
} */
.flex-center {
  display: flex;
  justify-content: center;
  align-content: center;
}
.position-ref {
  position: relative;
}
.top-right {
  position: absolute;
  top: 10px;
  right: 18px;
}
.content {
  text-align: center;
}
.title {
  font-size: 60px;
}
</style>

