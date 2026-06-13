import pymysql
conn = pymysql.connect(host='localhost', user='root', password='', database='yii2advanced')
cursor = conn.cursor()
cursor.execute('SHOW ENGINE INNODB STATUS')
status = cursor.fetchone()[2]
start = status.find('LATEST FOREIGN KEY ERROR')
end = status.find('TRANSACTIONS', start)
print(status[start:end])
