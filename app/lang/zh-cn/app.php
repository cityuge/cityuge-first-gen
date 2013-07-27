<?php 

return array(

	'appTitle' => 'CityU GE 指南',

	// Menu
	'nav_course' => '课程',
	'nav_allCourse' => '所有课程',
	'nav_cityUGECategory' => '精进教育 (GE)',
	'nav_otherCategory' => '其他',
	'nav_comment' => '留言',
	'nav_category' => '分类',
	'nav_department' => '学系',
	'nav_rss' => 'RSS',
	'nav_rssSite' => '网站的最新留言',
	'nav_rssCourse' => ':courseCode 的最新留言',

	'nav_search' => '搜寻',
	'nav_searchPlaceholder' => '课程编号或名称',

	'nav_acp' => '管理控制台',
	'nav_logout' => '注销',

	// Admin menu
	'admin_nav_site' => '网站主页',

	// Home
	'home_hotCourse' => '热门课程',
	'home_goodGradeCourse' => '好 Grade 课程',
	'home_goodGradeCourseNote' => '平均成绩高于或等于 B- 的首 :limit 个课程。',
	'home_badGradeCourse' => '烂 Grade 课程',
	'home_badGradeCourseNote' => '平均成绩低于 B- 的首 :limit 个课程。',
	'home_lightWorkloadCourse' => '轻松之选',
	'home_heavyWorkloadCourse' => '繁重之选',

	// Course
	'course' => '{1} 所有课程|[2,Inf] 所有课程：第 :page 页',
	'course_detail_title' => '{1} :courseCode 课程数据|[2,Inf] :courseCode 课程数据：第 :page 页',
	'course_code' => '编号',
	'course_title' => '名称',
	'course_department' => '学系',
	'course_category' => '分类',
	'course_level' => '程度',
	'course_edgeInfo' => 'EDGE 课程目录',
	'course_form2b' => '表格 2B',
	'course_comment' => '{0} 留言|[1,Inf] :count 则留言',
	'course_avgWorkload' => '平均工作量',
	'course_commentCount' => '留言',
	'course_noComment' => '现时未有留言。',
	'course_search_empty' => '请输入关键词搜寻。',
	'course_search_nothingFound' => '找不到相关课程，请输入其他关键词搜寻。',
	'course_search_resultTitle' => '{1} 搜寻「:keyword」的结果|[2,Inf] 搜寻「:keyword」的结果：第 :page 页',
	'course_metaDesc' => '城大精进教育 (Gateway Education) 课程清单。',
	'course_categoryTitle' => '{1} :category|[2,Inf] :category：第 :page 页',
	'course_category_metaDesc' => '城大精进教育 (Gateway Education) :category 课程清单。',
	'course_detail_metaDesc' => ':courseCode (:courseTitle) 的课程资料、留言、工作量及成绩统计。',
	'course_search_metaDesc' => '「:keyword」的搜寻结果。',
	'course_detail_info' => '基本数据',
	'course_detail_stats' => '统计',
	'course_detail_comment' => '留言',

	// Comment
	'comment' => '{1} 所有留言|[2,Inf] 所有留言：第 :page 页',
	'comment_desc' => '<p>现时共有 :count 则留言。</p>',
	'comment_new' => '发表',
	'comment_newTitle' => '发表对 :courseCode 的留言',
	'comment_id' => '留言编号',
	'comment_ipAdress' => 'IP 地址',
	'comment_semester' => '学期',
	'comment_instructor' => '导师',
	'comment_grade' => '成绩',
	'comment_grade_tooltip' => '成绩：:grade',
	'comment_workload' => '工作量',
	'comment_body' => '留言',
	'comment_createdAt' => '发表日期',
	'comment_submit' => '发表',
	'comment_created' => '留言已发表，感谢你的支持！',
	'comment_metaDesc' => 'CityU GE 指南的最新留言。',
	'comment_permalink' => '永久连结',
	'comment_share' => '分享这则留言',
	'comment_courseDetail' => '更多资料',
	'comment_show_title'=> '留言 #:id (:courseCode - :courseTitle)',
	'comment_show_admin' => '管理专用',
	'comment_whois' => 'WHOIS',
	'comment_show_shareDesc' => '<p>你可以用分享按钮 <i class="icon-share-alt"></i> 将这则留言分享到各大社交平台，亦可以将本页的网址直接分享给朋友。</p>',

	// Grade
	'grade_p' => 'Pass',
	'grade_f' => 'Fail',
	'grade_x' => 'Dropped',

	// Workload
	'workload_1' => '非常轻松',
	'workload_2' => '轻松',
	'workload_3' => '一般',
	'workload_4' => '繁重',
	'workload_5' => '非常繁重',

	// Department
	'department' => '学术部门',
	'department_noCourse' => '该学术部门并没有提供任何精进教育 (GE) 课程。',
	'department_metaDesc' => '城大的学术部门清单。',
	'department_courseMetaDesc' => '城大:department所提供的精进教育 (GE) 课程清单。',

	// Category
	'category_area1' => 'Area 1',
	'category_area2' => 'Area 2',
	'category_area3' => 'Area 3',
	'category_unireq' => '大学必修',
	'category_e' => 'E 仔班',
	'category_misc' => '其他',

	// Users & login
	'user_username' => '账户名称',
	'user_password' => '密码',
	'login_rememberMe' => '保持登入',
	'login_title' => '管理控制台',
	'login_submit' => '登入',
	'login_authorizedOnly' => '本页仅供获受权人士进入，请先登入！',
	'login_successful' => '登入成功！',
	'login_unsuccessful' => '你的帐户名称 / 密码组合错误。',

	// Admin
	'admin_title' => 'CityU GE 指南管理控制面板',
	'cache_purge' => '清除所有快取',
	'cache_purged' => '已清除系统内的所有快取！',

	// About
	'about' => '关于本网站',
	'meta_aboutDesc' => 'CityU GE 指南的宗旨、介绍及联络数据。',

	// Footer
	'footer_disclaimer' => '本网站是以实时上载留言的方式运作，所有数据仅供参考，并不构成任何推荐、保证或协议。Swiftzer 对所有留言的真实性、完整性及立场等，不负任何法律责任。<br />本网站与香港城市大学 (City University of Hong Kong, CityU) 并无任何关连。',
	'footer_nav_about' => '关于本网站',
	'footer_nav_facebookFanPage' => 'Facebook 专页',
	'footer_nav_devBlog' => '开发日志',
	'footer_nav_acp' => '管理控制台',

	// RSS Feed
	'feed_title' => 'CityU GE 指南',
	'feed_description' => '最新留言',
	'feed_metaTitle' => '订阅 CityU GE 指南的最新留言',
	'feed_course_title' => 'CityU GE 指南：:courseCode',
	'feed_course_description' => ':courseCode 的最新留言',
	'feed_course_metaTitle' => '订阅 :courseCode 的最新留言',

	// Meta
	'meta_homeDesc' => '专为香港城市大学学生而设的精进教育 (Gateway Education) 课程留言平台。分析各课程的成绩及工作量，为选科作好准备。',
	'meta_globalKeyword' => 'GE, Gateway Education, 通识, general education, 精进教育, 好 grade, 烂 grade, E 仔班, 补底班, City University of Hong Kong, 香港城市大学, 城市大学, 城大, 又一城市大学, 神大, CityU, City U, Shitty U, ShittyU, AIMS, Hong Kong, 香港',
	'excerptEllipse' => '[...]',

	// Error page
	'error_maintenance' => '维修进行中',
	'error_maintenance_detail' => '<p>网站现正进行维修，请于稍后时间再次造访。不便之处，敬请原谅！</p>',
	'error_404' => '找不到网页 (Error 404)',
	'error_404_detail' => '<p>请检查网址是否输入正确。</p>',
);