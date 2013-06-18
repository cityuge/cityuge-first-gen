<?php

class DepartmentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$departments = array(
			array('id' => '1','initial' => 'AC','title_zh' => '會計學系','title_en' => 'Department of Accountancy','url' => 'http://www.cb.cityu.edu.hk/ac/'),
			array('id' => '2','initial' => 'SS','title_zh' => '應用社會科學系','title_en' => 'Department of Applied Social Studies','url' => 'http://ssweb.cityu.edu.hk/apss/'),
			array('id' => '3','initial' => 'AIS','title_zh' => '亞洲及國際學系','title_en' => 'Department of Asian and International Studies','url' => 'http://www6.cityu.edu.hk/ais/'),
			array('id' => '4','initial' => 'BCH','title_zh' => '生物及化學系','title_en' => 'Department of Biology and Chemistry','url' => 'http://www6.cityu.edu.hk/bhdbapp/deptweb/'),
			array('id' => '5','initial' => 'CTL','title_zh' => '中文、翻譯及語言學系','title_en' => 'Department of Chinese, Translation and Linguistics','url' => 'http://ctl.cityu.edu.hk/'),
			array('id' => '6','initial' => 'CA','title_zh' => '土木及建築工程系','title_en' => 'Department of Civil and Architectural Engineering','url' => 'http://bccw.cityu.edu.hk/'),
			array('id' => '7','initial' => 'CS','title_zh' => '電腦科學系','title_en' => 'Department of Computer Science','url' => 'http://www.cityu.edu.hk/cs/'),
			array('id' => '8','initial' => 'EF','title_zh' => '經濟及金融系','title_en' => 'Department of Economics and Finance','url' => 'http://www.cb.cityu.edu.hk/ef/'),
			array('id' => '9','initial' => 'EE','title_zh' => '電子工程學系','title_en' => 'Department of Electronic Engineering','url' => 'http://www.ee.cityu.edu.hk/'),
			array('id' => '10','initial' => 'EN','title_zh' => '英文系','title_en' => 'Department of English','url' => 'http://www.english.cityu.edu.hk/en/'),
			array('id' => '11','initial' => 'IS','title_zh' => '資訊系統學系','title_en' => 'Department of Information Systems','url' => 'http://www.cb.cityu.edu.hk/is/'),
			array('id' => '12','initial' => 'MGT','title_zh' => '管理學系','title_en' => 'Department of Management','url' => 'http://www.cb.cityu.edu.hk/mgt/'),
			array('id' => '13','initial' => 'MS','title_zh' => '管理科學系','title_en' => 'Department of Management Sciences','url' => 'http://www.cb.cityu.edu.hk/ms/'),
			array('id' => '14','initial' => 'MKT','title_zh' => '市場營銷學系','title_en' => 'Department of Marketing','url' => 'http://www.cb.cityu.edu.hk/mkt/'),
			array('id' => '15','initial' => 'MA','title_zh' => '數學系','title_en' => 'Department of Mathematics','url' => 'http://www6.cityu.edu.hk/ma/'),
			array('id' => '16','initial' => 'MBE','title_zh' => '機械及生物醫學工程學系','title_en' => 'Department of Mechanical and Biomedical Engineering','url' => 'http://www.cityu.edu.hk/mbe/'),
			array('id' => '17','initial' => 'COM','title_zh' => '媒體與傳播系','title_en' => 'Department of Media and Communication','url' => 'http://www6.cityu.edu.hk/com/'),
			array('id' => '18','initial' => 'AP','title_zh' => '物理及材料科學系','title_en' => 'Department of Physics and Materials Science','url' => 'http://www.ap.cityu.edu.hk/'),
			array('id' => '19','initial' => 'SA','title_zh' => '公共及社會行政學系','title_en' => 'Department of Public and Social Administration','url' => 'http://www6.cityu.edu.hk/sa/'),
			array('id' => '20','initial' => 'SEEM','title_zh' => '系統工程及工程管理學系','title_en' => 'Department of Systems Engineering and Engineering Management','url' => 'http://www.cityu.edu.hk/seem/'),
			array('id' => '21','initial' => 'BST','title_zh' => '建築科技學部','title_en' => 'Division of Building Science and Technology','url' => 'http://www6.cityu.edu.hk/bst/'),
			array('id' => '22','initial' => 'SCM','title_zh' => '創意媒體學院','title_en' => 'School of Creative Media','url' => 'http://www.scm.cityu.edu.hk/'),
			array('id' => '23','initial' => 'SEE','title_zh' => '能源及環境學院','title_en' => 'School of Energy and Environment','url' => 'http://www6.cityu.edu.hk/see/'),
			array('id' => '24','initial' => 'SLW','title_zh' => '法律學院','title_en' => 'School of Law','url' => 'http://www6.cityu.edu.hk/slw/'),
			array('id' => '25','initial' => 'CB','title_zh' => '商學院','title_en' => 'College of Business','url' => 'http://www.cb.cityu.edu.hk/'),
			array('id' => '26','initial' => 'CLASS','title_zh' => '人文社會科學院','title_en' => 'College of Liberal Arts and Social Sciences','url' => 'http://www6.cityu.edu.hk/class/'),
			array('id' => '27','initial' => 'CSE','title_zh' => '科學及工程學院','title_en' => 'College of Science and Engineering','url' => 'http://www6.cityu.edu.hk/cse/cms/'),
			array('id' => '28','initial' => 'SCOPE','title_zh' => '專業進修學院','title_en' => 'School of Continuing and Professional Education','url' => 'http://www.scope.edu/'),
			array('id' => '29','initial' => 'CCIV','title_zh' => '中國文化中心','title_en' => 'Chinese Civilisation Centre','url' => 'http://www.cciv.cityu.edu.hk/'),
			array('id' => '30','initial' => 'ELC','title_zh' => '英語中心','title_en' => 'English Language Centre','url' => 'http://www.cityu.edu.hk/elc/')
		);

		DB::table('departments')->insert($departments);
	}

}