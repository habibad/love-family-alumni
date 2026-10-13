#!/usr/bin/env python3
"""Optional visual helper: compose two screenshots side by side, normalized to same preview width.
USAGE: python tools/side_by_side.py APPROVED.png BROWSER.png out.png
This is a human visual aid, NOT a pixel similarity score: reference is an illustrative design, not a browser rendering.
"""
import sys
from PIL import Image, ImageDraw
if len(sys.argv)!=4:
 raise SystemExit('usage: python side_by_side.py approved.png browser.png output.png')
imgs=[Image.open(p).convert('RGB') for p in sys.argv[1:3]]
W=650
scaled=[]
for im in imgs:
 scaled.append(im.resize((W, round(im.height*W/im.width))))
canvas=Image.new('RGB',(W*2+40,max(x.height for x in scaled)+60),'#ECEFF4')
for i,im in enumerate(scaled):
 x=i*(W+40)
 canvas.paste(im,(x,50))
ImageDraw.Draw(canvas).text((10,12),'APPROVED REFERENCE        |        LIVE CHROME SCREENSHOT',fill='#12203c')
canvas.save(sys.argv[3])