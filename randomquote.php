<?php
# File:    randomquote.php
# Purpose: read a random quote from file "quote" and display it.
# Update:	jonathan 5-22-08 : Now reads the file through a loop instead of loading it into an array.
#		jonathan 5-19-08
# Steps: Opens "quotes", picks a random line, uses a while loop to get to the line in the file, and then attaches HTML table tags to the quote before displaying it.
# Special: The "quotes" file is not the original quotes file. The HTML has been removed to make it simpler. The original quotes file can be found at "quotes.original"

# Since this is called from subdirectories as well as civilward directory, need explicit path to quotation file
# $quotefile = '/u/ssc/jmai/public_html/history/quotes';
$quotefile = __DIR__ . '/quotes';
$fh = fopen($quotefile,'r'); # Opens quotes file to a handle, don't want to die on failure.

$rand = rand ( 0, 222 );	 # There are 223 quotes
$line = $rand * 2 + 1;		 # Quote is found at this line
# The first half of the quote is found on $line, the second half of the quote is found on $line+1.
# First part of quote is the quote itself. Second part of quote is who said the quote.
# Each quote takes two lines in the file.

# The most effective way to select a particular line in a file is through a loop.
$counter = 0;
while ((! feof($fh)) && ($counter <= $line)) {
  $s = fgets($fh,1048676); 			# Each time fgets is called, we go down one line.
  if ($counter == $line) {
    $quote1 = $s; 					# Quote1 = the current $s
	$quote2 = fgets($fh,1048676); 	# Quote2= the line after the current $s
  }
  $counter++;
}
fclose($fh); # Close handle


# The format of what needs to be echoed looks like this:
# (HTML CODE) + (QUOTE1) + (MORE HTML) + (QUOTE2) + (LAST BIT OF HTML)
# This is because of the way the website's HTML table is structured.

$display =  "<center><table width=80%><tr><td colspan=2><font face=Times, TNRoman, Goudy, Garamond, serif size='4'>";
$display .= $quote1;
$display .= "</font></td></tr><tr><td><BR></td></tr><tr><td width=100></td><td align=right><font face=Times, TNRoman, Goudy, Garamond, serif size=3><b>";
$display .= $quote2;
$display .= "</b></font></td></tr></table></center>";

echo $display;
?>
