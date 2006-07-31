function pxotron(troll,niveau)
{
  var test;
  var test1;
  var test2;
  if ( (niveau != "?") && (niveau != "< 2") && (niveau != "2-4") && 
       (niveau != "4-6")&&(niveau != "6-8") && (niveau != "8-10")&&
       (niveau != "10-12")&&(niveau != "12-14")&&(niveau != "14-16")&&
       (niveau != "16-18")&&(niveau != "18-20")&&(niveau != "> 20")) { // si niveau fixe
    test = niveau - ( 2 * (troll - niveau)) + 10;
    if (test < "0") test = "0";
  }
  else {
    if (niveau == "?") {
      test = "Niveau monstre inconnu";}
    if (niveau == "< 2") {
      test = 1 - ( 2 * (troll - 1)) + 10;
      if (test < "0") test = "0";
    }
    if (niveau == "2-4") {
      test1 = 2 - ( 2 * (troll - 2)) + 10;
      test2 = 4 - ( 2 * (troll - 4)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "4-6") {
      test1 = 4 - ( 2 * (troll - 4)) + 10;
      test2 = 6 - ( 2 * (troll - 6)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "6-8") {
      test1 = 6 - ( 2 * (troll - 6)) + 10;
      test2 = 8 - ( 2 * (troll - 8)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "8-10") {
      test1 = 8 - ( 2 * (troll - 8)) + 10;
      test2 = 10 - ( 2 * (troll - 10)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "10-12") {
      test1 = 10 - ( 2 * (troll - 10)) + 10;
      test2 = 12 - ( 2 * (troll - 12)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "12-14") {
      test1 = 12 - ( 2 * (troll - 12)) + 10;
      test2 = 14 - ( 2 * (troll - 14)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "14-16") {
      test1 = 14 - ( 2 * (troll - 14)) + 10;
      test2 = 16 - ( 2 * (troll - 16)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "16-18") {
      test1 = 16 - ( 2 * (troll - 16)) + 10;
      test2 = 18 - ( 2 * (troll - 18)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "18-20") {
      test1 = 18 - ( 2 * (troll - 18)) + 10;
      test2 = 20 - ( 2 * (troll - 20)) + 10;
      if (test1 < "0") test1 = "0";
      if (test2 < "0") test2 = "0";
      if (test2 == test1) test = "0";
      else                test = "" + test1 + '-' + test2;
    }
    if (niveau == "> 20") {
      test1 = 20 - ( 2 * (troll - 20)) + 10;
      if (test1 < "0") test = "> 0";
      else             test = "" + '>' + test1;
    }
  }
  return test;
}
