SELECT firstname, lastname, title, question, answer
	FROM entity_users EU
		JOIN xref_users_surveys XUS 
			ON EU.id = XUS.user_id
		JOIN entity_surveys ES
			ON XUS.survey_id = ES.id
		JOIN xref_surveys_questions XSQ
			ON ES.id = XSQ.survey_id
		JOIN entity_questions EQ
			ON XSQ.question_id = EQ.id
		JOIN xref_questions_answers XQA
			ON EQ.id = XQA.question_id
		JOIN entity_answers EA
			ON XQA.answer_id = EA.id