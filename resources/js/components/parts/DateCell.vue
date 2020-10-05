<template>
  <td :class="`calendar-td ${day.month !== currentMonth ? 'gray' : ''} ${todayClassName}`">{{ day.date }}</td>
</template>

<script>
export default {
  props:{
    day: Object,
    todayDate: Object,
    currentMonth: Number,
  },
  methods: {
  },
  computed: {
    todayClassName() {
      if (
        this.day.year === this.todayDate.year &&
        this.day.month === this.todayDate.month &&
        this.day.date === this.todayDate.date
      ) {
        return "red";
      } else {
        return "";
      }
    }
  },
  mounted() {}
};

</script>
<style scoped>
</style>