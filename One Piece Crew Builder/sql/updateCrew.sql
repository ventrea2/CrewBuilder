UPDATE crew
SET
	name = :name,
	bounty = :bounty,
	abilities = :abilities,
	Info = :Info
WHERE crewid = :crewid;