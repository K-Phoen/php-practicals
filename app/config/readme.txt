creation command at root :
	mysql uframework -h127.0.0.1 -P32768 -uuframework -pp4ssw0rd < app/config/schema.sql

connexion at db :

	mysql uframework -h127.0.0.1 -P32768  -uuframework -pp4ssw0rd


describing statuses table:

	describe statuses;

Inserting an element: (date is at format datetime. Here I use null to insert)
	INSERT INTO statuses VALUES ('1','user','title','message','2010-04-02 15:28:22');

Showing elements in table:
	SELECT * FROM statuses;

