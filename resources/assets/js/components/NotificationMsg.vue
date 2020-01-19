<template>
  <notifications group="notificationStatus" :duration="5000" :width="500" animation-name="v-fade-left" position="bottom right">
    <template slot="body" slot-scope="props">
      <div :class="'custom-template-notify '+props.item.type">
        <div class="custom-template-notify-icon">
          <i v-if="props.item.type === 'success'" class="fas fa-check-circle"></i>
          <i v-if="props.item.type === 'error'" class="fas fa-exclamation-circle"></i>
        </div>
        <div class="custom-template-notify-content">
          <div class="custom-template-notify-title">
            {{props.item.title}}
          </div>
          <div class="custom-template-notify-text" v-html="props.item.text"></div>
        </div>
        <div class="custom-template-notify-close" @click="props.close">
          <i class="fas fa-times"></i>
        </div>
      </div>
    </template>
  </notifications>
</template>