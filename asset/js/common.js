const $ = require('jquery');
/**
 * 组件-header
 */
// 点击弹出手机菜单
$('#header-container .toggle-menu-btn').on('click',(e)=>{
  // 禁止滑动
  $('body').css('overflow','hidden');
  // 显示遮罩
  $('#header-container .mask').removeClass('hide');
  // 显示菜单栏
  $('#header-container .mobile-menu').css('left',0);
});

// 点击弹出搜索框
$('#header-container .toggle-search-form-btn').on('click',(e)=>{
  // 禁止滑动
  $('body').css('overflow','hidden');
  // 显示搜索框和遮罩
  $('#header-container .search-form').removeClass('hide');
  $('#header-container .mask').removeClass('hide');
  // 图标变 X
  $('#header-container .toggle-search-form-btn i').addClass('fa-remove');
});
// npm install @types/jquery --save
// 遮罩点击事件
$('#header-container .mask').on('click',(e)=>{
  // 允许滑动
  $('body').css('overflow','auto');
  // 关闭菜单栏, 搜索框和遮罩
  $('#header-container .mobile-menu').css('left','-70%');
  $('#header-container .search-form').addClass('hide');
  $('#header-container .mask').addClass('hide');
  // 图标还原 搜索
  $('#header-container .toggle-search-form-btn i').removeClass('fa-remove');
})

/**
 * 组件-card-search
 */

// 点击搜索
$('#card-search-container button').on('click',(e)=>{
  // ?s=111
  // $('#card-search-container input')
  const searchValue = $('#card-search-container input').val();
  console.log(searchValue)
})