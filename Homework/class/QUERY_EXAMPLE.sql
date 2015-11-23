SELECT @NUM_QS = 2;
SELECT @NUM_ANS = 8;
BEGIN;
INSERT INTO brandon.entity_surveys (title, open, close) VALUES ('Survey2', CURDATE(), '2015-12-25');
SELECT LAST_INSERT_ID() INTO @CUR_SURVEY_ID;
SELECT id FROM brandon.entity_users WHERE email = 'toby@gomes.com' INTO @CUR_USER_ID;
INSERT INTO brandon.xref_users_surveys (user_id, survey_id) VALUES (@CUR_USER_ID, @CUR_SURVEY_ID);
COMMIT;