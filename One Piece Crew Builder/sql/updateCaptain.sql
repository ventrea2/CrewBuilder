UPDATE captain
SET
	name = :name,
	bounty = :bounty,
	crewName = :crewName,
	abilities = :abilities,
	Info = :Info
WHERE crewid = :crewid;