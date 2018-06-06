import unittest, time
from selenium import webdriver

class MeichuWebTesting(unittest.TestCase): # inherit unittest

	def setUp(self): # execute before each test
		self.driver = webdriver.Chrome()

	def testcase_1(self): 
		# open website
		self.driver.get("https://meichu.games")			
		# check title is matched or not
		assert "首頁 - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title
		self.driver.close()

	def testcase_2(self): 
		# open website
		self.driver.get("https://meichu.games/games/opening")			
		# check title is matched or not
		assert "開幕 - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title
		self.driver.close()

	def testcase_3(self): 
		# open website
		self.driver.get("https://meichu.games/games/billiards")			
		# check title is matched or not
		assert "撞球表演賽 - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title
		self.driver.close()

	def testcase_4(self): 
		# open website
		self.driver.get("https://meichu.games/games/women-tabletennis")			
		# check title is matched or not
		assert "女子桌球表演賽 - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title
		self.driver.close()

	def testcase_5(self): 
		# open website
		self.driver.get("https://meichu.games/games/football-general")			
		# check title is matched or not
		assert "足球表演賽（一般組） - 戊戌梅竹 | 2018 Meichu Games" in self.driver.title
		self.driver.close()

if __name__ == "__main__":
	unittest.main()